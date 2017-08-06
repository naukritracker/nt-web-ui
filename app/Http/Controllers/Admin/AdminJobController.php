<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use App\Models\State;
use App\Models\JobPosting;
use App\Models\Company;
use App\Models\Visa;
use App\Models\Industry;
use Carbon\Carbon;
use Form;
use Auth;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function showJobPosting(Request $request)
    {
        if ($request->has('user')) {
            $id = $request->get('user');
            $data['selecteduser'] = $id;
        } else {
            $id = Auth::user()->id;
            $data['selecteduser'] = null;
        }

        $allcountries = Country::all();
        $countries = array();
        foreach ($allcountries as $country) {
            $countries[$country->id] = $country->country;
        }
        $data['users'] = User::all();
        $selecteduser = User::find($id);
        
        if ($request->has('sort')) {
            $sort = $request->get('sort');
        } else {
            $sort = 'id';
        }

        if ($request->has('order')) {
            $order = $request->get('order');
        } else {
            $order = 'DESC';
        }


        if ($selecteduser->hasRole(['admin','su']) && $selecteduser->id == Auth::user()->id) {
            $data['jobs'] = JobPosting::orderBy($sort, $order)->paginate(15);
        } else {
            $data['jobs'] = JobPosting::where('user_id', $id)->orderBy($sort, $order)->paginate(15);
        }
        $data['countries'] = $countries;
        return view('admin.jobposting.view')->with('data', $data)->with('sort', $sort)->with('order', $order);
    }

    public function viewJobPosting($job)
    {
        $job = JobPosting::find($job);
        $data['title'] = $job->title;
        
        $html = '';
        if ($job->description != '') {
            $html .= '<h3>Description</h3><p>'.html_entity_decode($job->description).'</p>';
        }
        if ($job->requirements != '') {
            $html .= '<h3>Requirements</h3><p>'.html_entity_decode($job->requirements).'</p>';
        }
        if ($job->role != '') {
            $html .= '<h3>Role</h3><p>'.$job->role.'</p>';
        }
        if ($job->open_positions != 0) {
            $html .= '<h3>Open Positions</h3><p>'.$job->open_positions.'</p>';
        }
        
        if ($job->minimum_education != '') {
            $html .= '<h3>Minimum Education</h3><p>';
            $html .= $job->getReadableQualification($job->minimum_education);
            $html .= '</p>';
        }

        if ($job->minimum_experience != '') {
            $html .= '<h3>Minimum Experience</h3><p>';
            $html .= $job->minimum_experience .'+ years';
            $html .= '</p>';
        }

        if ($job->salary_range_start != 0 || $job->salary_range_end != 0) {
            $html .= '<h3>Salary offered</h3><p>';
            if ($job->salary_range_start != 0) {
                $html .= ''.$job->salary_range_start;
            } else {
                $html .= '0';
            }

            if ($job->salary_range_start != 0) {
                ' - '.$job->salary_range_end;
            } else {
                $html .= '0';
            }

            $html .= '</p>';
        }
        $html .= '<h3>Location Details</h3>';
        if ($job->job_locations != '') {
            $html .= '<h4><u>Work Location(s)</u></h4><p>';
            $work_locations_array = explode('||', $job->job_locations);
            $isFirst = 1;
            foreach ($work_locations_array as $job_location) {
                if ($job_location != 0) {
                    $location = State::find($job_location);
                    if ($isFirst) {
                        $isFirst = 0;
                        $html .= $location->state.'('.$location->country->country.')';
                    } else {
                        $html .= ', '.$location->state.'('.$location->country->country.')';
                    }
                } else {
                    $html .= 'None Specified';
                }
            }
            $html .= '</p>';
        }
        if ($job->country_id == 0 && $job->state_id == 0) {
            $html .= '<p>No location specified</p>';
        } else {
            $html .= '<h4><u>Job Location</u></h4><p>';
            if ($job->state_id != 0) {
                $html .= ''.$job->state->state.'';
            }
            if ($job->country_id != 0) {
                $html .= ', '.$job->country->country.'';
            }
            $html .= '</p>';
        }

        if ($job->visa == '') {
            $html .= '<p>No visa requirements specified</p>';
        } else {
            $html .= '<h4><u>Visa Types</u></h4><p>';
            $visa_array = explode('||', $job->visa);
            $isFirst = 1;
            foreach ($visa_array as $visa) {
                if ($visa != 0) {
                    $location_country = Visa::find($visa);
                    if ($isFirst) {
                        $isFirst = 0;
                        $html .= $location_country->country;
                    } else {
                        $html .= ', '.$location_country->country;
                    }
                } else {
                    $html .= 'Not Required';
                }
            }
            $html .= '</p>';
        }
        
        
        $html .= '</p>';

        if ($job->job_type != '' || $job->employment_type != '' || $job->gender_type != '') {
            $html .= '<h3>Job Details</h3>';
        }
        if ($job->job_type != '') {
            $html .= '<h4><u>Job Type</u></h4><p>'.$job->getReadableJobType($job->job_type).'</p>';
        }

        if ($job->employment_type != '') {
            $html .= '<h4><u>Employment Type</u></h4><p>'.$job->getReadableEmploymentType($job->employment_type).'</p>';
        }

        if ($job->gender_type != '') {
            $html .= '<h4><u>Gender</u></h4><p>'.$job->getReadableGenderType($job->gender_type).'</p>';
        }

        if ($job->company_id != 0) {
            $html .= '<h3>Employer Details</h3><p>'.$job->company->name.'('.$job->company->state->state.' / '.$job->company->country->country.')</p>';
        }
        if ($job->industry != '') {
            $html .= '<h4><u>Industry</u></h4><p>'.$job->industry.'</p>';
        }
        if ($job->apply != '' || $job->walkin != 0) {
            $html .= '<h3>Application Type</h3></p>';
            if ($job->apply != '') {
                $html .= '<h4><u>Apply At</u></h4><p>'.$job->apply.'</p><h4><u>Walk-In</u></h4><p>No</p>';
            } elseif ($job->walkin != 0) {
                $html .= '<h4><u>Apply At</u></h4><p>Unavailable</p><h4><u>Walk-In</u></h4><p>Yes</p>';
            }
            $html .= '</p>';
        }

        $data['body'] = $html;
        return $data;
    }

    public function editJobPosting($job)
    {
        $job = JobPosting::find($job);
        $countries = Country::all();
        $selectcountry = array();
        foreach ($countries as $c) {
            $selectcountry[$c->id] = $c->country;
        }
        $state = State::find($job->state_id);
        $selectstate = array();
        if ($state && $state->state) {
            $selectstate[$state->id] = $state->state;
        }

        $selectindustry = array();
        $industries = Industry::orderBy('industry')->get();
        foreach ($industries as $i) {
            $selectindustry[$i->industry] = $i->industry;
        }

        $companies = Company::all();
        $selectcompany = array();
        $selectcompany['new'] = 'Add new';
        $selectcompany['confidential'] = 'Confidential';
        foreach ($companies as $company) {
            $selectcompany[$company->id] = $company->name.'('.$company->state->state.' / '.$company->country->country.')';
        }

        $statesall = State::all();
        $selectstateall = array();
        $selectstateall[0] = 'Not Specified';
        foreach ($statesall as $state) {
            $selectstatesall[$state->id] = $state->country->country.' - '.$state->state;
        }
        $selectvisa = array();
        $selectvisa[0] = 'Not Required';
        $visas = Visa::where('country_id', $job->country->id)
                    ->get();
        if (count($visas)>0) {
            foreach ($visas as $visa) {
                $selectvisa[$visa->visa] = $visa->visa;
            }
        }
        

        $minimum_education = array(
                '0' => 'None',
                'sse' => '10th grade or Equivalent',
                'hsse' => '12th grade or Equivalent',
                'ug' => 'Under Graduate',
                'pg' => 'Post Graduate',
            );

        $minimum_experience = array();
        for ($i=0; $i < 65; $i++) {
            $minimum_experience[$i] = $i.'+ years';
        }

        $selectjobtype = array(
                'full' => 'Full time',
                'part' => 'Part time',
                '0' => 'Any',
            );

        $selectemploymenttype = array(
                'permanent' => 'Permanent',
                'contract' => 'Contract',
                '0' => 'Any',
            );

        $selectgendertype = array(
                'male' => 'Male',
                'female' => 'Female',
                '0' => 'Any',
            );
 
        $data['title'] = 'Edit Job';
        
        $html = '';
        $html .= Form::open(['route'=>array('SaveJobPosting',$job->id),'id="edit_jobposting_form']);
        
        $html .= '<fieldset>';

        $html .= '<div class="clearfix">';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::text('title', $job->title, ['placeholder'=>'Enter job title', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::text('role', $job->role, ['placeholder'=>'Role (Designation)', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::number('open_positions', $job->open_positions, ['placeholder'=>'No of open positions', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::select('minimum_education', $minimum_education, $job->minimum_education, ['placeholder'=>'Minimum education', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('minimum_experience', $minimum_experience, $job->minimum_experience, ['placeholder'=>'Minimum experience', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $updatedselectstatesall = $selectstatesall;
        $updatedselectstatesall[0] = 'Not Specified';
        $html .= Form::select('work_locations[]', $updatedselectstatesall, explode("||", $job->job_locations), ['placeholder'=>'Select one or multiple work locations(s)', 'class'=>'form-control','id'=>'work_locations','multiple']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="col-xs-5">';
        $html .= '<div class="form-group">';
        $html .= '<label>Salary in AED</label>';
        $html .= Form::number('salary_range_start', $job->salary_range_start, ['placeholder'=>'Start Range', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-xs-2 text-center">';
        $html .= ' to ';
        $html .= '</div>';
        $html .= '<div class="col-xs-5">';
        $html .= '<div class="form-group">';
        $html .= '<label>Salary in AED</label>';
        $html .= Form::number('salary_range_end', $job->salary_range_end, ['placeholder'=>'End Range', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $preferred_nationality['any_arabic_national'] = 'Any Arabic National';
        $preferred_nationality['any_gcc_national'] = 'Any GCC National';
        $preferred_nationality['any_european_national'] = 'Any European National';
        $preferred_nationality['any_anglophone_national'] = 'Any Anglophone National';
        $preferred_nationality['any_cis_national'] = 'Any CIS National';
        foreach ($selectcountry as $id => $country) {
            $preferred_nationality[$id] = $country;
        }
        $html .= Form::select('preferred_nationality[]', $preferred_nationality, explode('||', $job->preferred_nationality), ['placeholder'=>'Select preferred nationality', 'class'=>'form-control','id'=>'preferred_nationality','multiple']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::select('job_type', $selectjobtype, $job->job_type, ['placeholder'=>'Select job type', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::select('employment_type', $selectemploymenttype, $job->employment_type, ['placeholder'=>'Select employment type', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('gender_type', $selectgendertype, $job->gender_type, ['placeholder'=>'Select gender type', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('country_id', $selectcountry, $job->country_id, ['placeholder'=>'Select job location', 'class'=>'form-control','id' => 'country_id','required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('state_id', $selectstate, $job->state_id, ['placeholder'=>'Select specific job location', 'class'=>'form-control','id' => 'state_id','required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('visa[]', $selectvisa, explode('||', $job->visa), ['placeholder'=>'Select one or multiple visa(s)', 'class'=>'form-control','id'=>'visa_id' ,'required','multiple']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-xs-12 text-center">';
        $html .= '<div class="form-group">';
        $html .= Form::select('industry', $selectindustry, $job->industry, ['placeholder'=>'Select industry','class'=>'form-control','id'=>'industry']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('company', $selectcompany, $job->company_id, ['placeholder'=>'Select employer','class'=>'form-control','id'=>'company','required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::text('apply_url', $job->apply_url, ['placeholder'=>'Add a URL for apply now button', 'class'=>'form-control','id'=>'apply']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= '<div class="checkbox">
                    <label> <input type="checkbox" name="walkin" value="1"';
        if (isset($job->walkin) && $job->walkin == 1) {
            $html .= 'checked';
        }
        $html .= '>Mark Job Posting as Walk In Type</label> 
                </div>';
        $html .= '</div>';
        $html .= '</div>';



        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::text('short_description', $job->short_description, ['placeholder'=>'Enter a short description', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= '<textarea class="form-control" name="description" placeholder="Provide description" required rows="1">'.$job->description.'</textarea>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= '<textarea class="form-control" name="requirements" placeholder="Provide some requirements" required rows="1">'.$job->requirements.'</textarea>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        $html .= '<div class="modal-footer">
            <input type="submit" class="btn btn-warning" name="preview" value="Preview">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="save" value="Save Changes">
          </div>';
        $html .= Form::token();
        $html .= Form::close();

        $html .= '</fieldset>';

        $data['body'] = $html;
        return $data;
    }

    public function addJobPosting()
    {
        $allcountries = Country::all();
        $countries = array();
        foreach ($allcountries as $country) {
            $countries[$country->id] = $country->country;
        }
        return view('admin.jobposting.add')->with('countries', $countries);
    }

    public function loadJobPostingForm()
    {
        $html = "";
        $countries = Country::all();
        $selectcountry = array();
        foreach ($countries as $c) {
            $selectcountry[$c->id] = $c->country;
        }

        $selectstate = array();
        $selectstate[0] = 'Not Required';

        $selectindustry = array();
        $industries = Industry::orderBy('industry')->get();
        foreach ($industries as $i) {
            $selectindustry[$i->industry] = $i->industry;
        }

        $companies = Company::all();
        $selectcompany = array();
        $selectcompany['new'] = 'Add new';
        $selectcompany['confidential'] = 'Confidential';
        foreach ($companies as $company) {
            $selectcompany[$company->id] = $company->name.'('.$company->state->state.' / '.$company->country->country.')';
        }

        $statesall = State::all();
        $selectstateall = array();
        $selectstateall[0] = 'Not Specified';
        foreach ($statesall as $state) {
            $selectstatesall[$state->id] = $state->country->country.' - '.$state->state;
        }

        $minimum_education = array(
                '0' => 'None',
                'sse' => '10th grade or Equivalent',
                'hsse' => '12th grade or Equivalent',
                'ug' => 'Under Graduate',
                'pg' => 'Post Graduate',
            );

        $minimum_experience = array();
        for ($i=0; $i < 65; $i++) {
            $minimum_experience[$i] = $i.'+ years';
        }

        $selectjobtype = array(
                'full' => 'Full time',
                'part' => 'Part time',
                '0' => 'Any',
            );

        $selectemploymenttype = array(
                'permanent' => 'Permanent',
                'contract' => 'Contract',
                '0' => 'Any',
            );

        $selectgendertype = array(
                'male' => 'Male',
                'female' => 'Female',
                '0' => 'Any',
            );

      

        $html .= Form::open(['route'=>'SaveJobPosting','id'=>'add_jobposting_form']);

        $html .= '<fieldset>';

        $html .= '<div class="clearfix">';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::text('title', null, ['placeholder'=>'Title', 'class'=>'form-control', 'id'=>'title', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::text('role', null, ['placeholder'=>'Role (Designation)', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::number('open_positions', null, ['placeholder'=>'No of open positions', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::select('minimum_education', $minimum_education, null, ['placeholder'=>'Minimum education', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('minimum_experience', $minimum_experience, null, ['placeholder'=>'Minimum experience', 'class'=>'form-control', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $updatedselectstatesall = $selectstatesall;
        $updatedselectstatesall[0] = 'Not Specified';
        $html .= Form::select('work_locations[]', $updatedselectstatesall, null, ['placeholder'=>'Select one or multiple work locations(s)', 'class'=>'form-control','id'=>'work_locations','multiple']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="col-xs-5">';
        $html .= '<div class="form-group">';
        $html .= '<label>Salary in AED</label>';
        $html .= Form::number('salary_range_start', null, ['placeholder'=>'Start Range', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-xs-2 text-center">';
        $html .= ' to ';
        $html .= '</div>';
        $html .= '<div class="col-xs-5">';
        $html .= '<div class="form-group">';
        $html .= '<label>Salary in AED</label>';
        $html .= Form::number('salary_range_end', null, ['placeholder'=>'End Range', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $preferred_nationality['any_arabic_national'] = 'Any Arabic National';
        $preferred_nationality['any_gcc_national'] = 'Any GCC National';
        $preferred_nationality['any_european_national'] = 'Any European National';
        $preferred_nationality['any_anglophone_national'] = 'Any Anglophone National';
        $preferred_nationality['any_cis_national'] = 'Any CIS National';
        foreach ($selectcountry as $id => $country) {
            $preferred_nationality[$id] = $country;
        }
        $html .= Form::select('preferred_nationality[]', $preferred_nationality, null, ['placeholder'=>'Select preferred nationality', 'class'=>'form-control','id'=>'preferred_nationality','multiple']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::select('job_type', $selectjobtype, null, ['placeholder'=>'Select job type', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<div class="form-group">';
        $html .= Form::select('employment_type', $selectemploymenttype, null, ['placeholder'=>'Select employment type', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('gender_type', $selectgendertype, null, ['placeholder'=>'Select gender type', 'class'=>'form-control']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('country_id', $selectcountry, null, ['placeholder'=>'Select job location', 'class'=>'form-control','id' => 'country_id','required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('state_id', $selectstate, null, ['placeholder'=>'Select specific job location', 'class'=>'form-control','id' => 'state_id','required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('visa[]', [], null, ['placeholder'=>'Select one or multiple visa(s)', 'class'=>'form-control','id'=>'visa_id' ,'required','multiple']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-xs-12 text-center">';
        $html .= '<div class="form-group">';
        $html .= Form::select('industry', $selectindustry, null, ['placeholder'=>'Select industry','class'=>'form-control','id'=>'industry']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::select('company', $selectcompany, null, ['placeholder'=>'Select employer','class'=>'form-control','id'=>'company','required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::text('apply_url', null, ['placeholder'=>'Add a URL for apply now button', 'class'=>'form-control','id'=>'apply']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= '<div class="checkbox">
                    <label> <input type="checkbox" name="walkin" value="1">Mark Job Posting as Walk In Type</label>
                </div>';
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= Form::text('short_description', null, ['placeholder'=>'Enter a short description', 'class'=>'form-control', 'id'=>'short_description', 'required']);
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= '<textarea class="form-control click-to-empty" name="description" placeholder="Provide description" required rows="1">Provide longer description</textarea>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="col-sm-12">';
        $html .= '<div class="form-group">';
        $html .= '<textarea class="form-control click-to-empty" name="requirements" placeholder="Provide requirements" required rows="1">Provide some requirements</textarea>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        $html .= '<div class="col-xs-12 text-center">
  	    <input type="submit" class="btn btn-warning" name="preview" value="Preview">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="save" value="Add Job">
        </div>';

        $html .= '</div>';

        $html .= '</fieldset>';

        $html .= Form::token();
        $html .= Form::close();


        return $html;
    }

    public function checkTitle(Request $request, $value=null)
    {
        if ($value == null) {
            $value = $request->get('title');
        }

        if (JobPosting::where('title', $value)->count()>0) {
            return true;
        }
        return false;
    }


    public function previewJobPosting(Request $request)
    {
        $jobposting = new JobPosting;

        $data['title'] = $request->has('title') ? $request->get('title') : '';
        $data['short_description'] = $request->has('short_description') ? $request->get('short_description') : '';
        $data['description'] = $request->has('description') ? $request->get('description') : '';
        $data['requirements'] = $request->has('requirements') ? $request->get('requirements') : '';
        $data['role'] = $request->has('role') ? $request->get('role') : '';
        $data['open_positions'] = $request->has('open_positions') ? $request->get('open_positions') : 0;
        $data['minimum_education'] = $request->has('minimum_education') ? $request->get('minimum_education') : '';
        $data['minimum_experience'] = $request->has('minimum_experience') ? $request->get('minimum_experience') : 0;
        $worklocations = $request->has('work_locations') ? $request->get('work_locations') : array();
        $data['work_locations'] = '';
        if (count($worklocations)) {
            foreach ($worklocations as $loc) {
                if ($loc != 0 && $loc != '') {
                    $state = State::find($loc);
                    $data['work_locations'] .= $state->state.'('.$state->country->country.'), ';
                }
            }
        }
        $data['salary_range_start'] = $request->has('salary_range_start') ? $request->get('salary_range_start') : 0;
        $data['salary_range_end'] = $request->has('salary_range_end') ? $request->get('salary_range_end') : 0;
        $preff_nat = $request->has('preferred_nationality') ? $request->get('preferred_nationality') : array();
        $data['preferred_nationality'] = '';
        if (count($preff_nat) && $preff_nat != 0) {
            foreach ($preff_nat as $nat) {
                if ($nat != 0 && $nat != '') {
                    $data['preferred_nationality'] .= $jobposting->getCountryName($nat).', ';
                }
            }
        }

        $data['job_type'] = $request->has('job_type') ? $jobposting->getReadableJobType($request->get('job_type')) : '';
        $data['employment_type'] = $request->has('employment_type') ? $jobposting->getReadableEmploymentType($request->get('employment_type')) : '';
        $data['gender_type'] = $request->has('gender_type') ? $request->get('gender_type') : '';
        $data['visa'] = $request->has('visa') ? $request->get('visa') : '';
        $data['company_id'] = $request->has('company') ? $request->get('company') : 0;
        if ($data['company_id'] != 0) {
            $company = Company::find($data['company_id']);
            $data['company']['name'] = $company->name;
            $data['company']['state']['state'] = $company->state->state;
            $data['company']['country']['country'] = $company->country->country;
        }
        $data['industry'] = $request->has('industry') ? $request->get('industry') : '';
        $data['walkin'] = $request->has('walkin') ? $request->get('walkin') : '';
        $data['apply'] = $request->has('apply') ? $request->get('apply') : '';
        $data['created_at'] = Carbon::parse(date('Y-m-d', strtotime('-1 days')))->diffForHumans();
        $data['updated_at'] = Carbon::parse(date('Y-m-d'))->diffForHumans();
        $data['country_id'] = $request->has('country_id') ? $request->get('country_id') : 0;
        $data['state_id'] = $request->has('state_id') ? $request->get('state_id') : 0;
        if ($request->has('state_id')) {
            $data['state'] = State::select('state')->where('id', $data['state_id'])->first();
        } else {
            $data['state']['state'] = '';
        }

        if ($request->has('country_id')) {
            $data['country'] = Country::select('country')->where('id', $data['country_id'])->first();
        } else {
            $data['country']['country'] = '';
        }
        return view('client.jobdetailspreview')->with('data', $data);
    }

    public function saveJobPosting(Request $request, $id=null)
    {
        if ($request->has('preview')) {
            return redirect()->route('PreviewPosting', array($request));
        }
        if ($id != null) {
            $this->validate($request, [
            'title' => 'required|unique:jobposting,title,'.$id,
            'short_description' => 'required',
            'role' => 'required',
            'company' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'apply_url' => 'url|unique:jobposting,apply,'.$id,
            ]);
        } else {
            $this->validate($request, [
            'title' => 'required|unique:jobposting,title',
            'short_description' => 'required',
            'role' => 'required',
            'company' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'apply_url' => 'url|unique:jobposting,apply',
            ]);
        }
        

        try {
            if ($id != null) {
                $job = JobPosting::find($id);
                $job->modified_user_id = Auth::user()->id;
                $job->updated_at = date('Y-m-d H:i:s');
            } else {
                $job = new JobPosting;
                $job->user_id = Auth::user()->id;
                $job->modified_user_id = Auth::user()->id;
                $job->created_at = date('Y-m-d H:i:s');
                $job->updated_at = date('Y-m-d H:i:s');
            }
            $workLocations = null;
            if ($request->has('work_locations')) {
                if (is_array($request->get('work_locations'))) {
                    $workLocations = implode('||',$request->get('work_locations'));
                } else {
                    $workLocations = $request->get('work_locations');
                }
            }
            $visa = null;
            if ($request->has('visa')) {
                if (is_array($request->get('visa'))) {
                    $visa = implode('||',$request->get('visa'));
                } else {
                    $visa = $request->get('visa');
                }
            }
            $preferredNationality = null;
            if ($request->has('preferred_nationality')) {
                if (is_array($request->get('preferred_nationality'))) {
                    $preferredNationality = implode('||',$request->get('preferred_nationality'));
                } else {
                    $preferredNationality= $request->get('preferred_nationality');
                }
            }

            $job->title = $request->get('title');
            $job->posted_by_employer = 0;
            $job->short_description = $request->get('short_description');
            $job->description = $request->get('description');
            $job->requirements = $request->get('requirements');
            $job->role = $request->get('role');
            $job->open_positions = $request->get('open_positions');
            $job->minimum_education = $request->get('minimum_education');
            $job->minimum_experience = $request->get('minimum_experience');
            $job->job_locations = $workLocations;
            $job->salary_range_start = $request->get('salary_range_start');
            $job->salary_range_end = $request->get('salary_range_end');
            $job->preferred_nationality = $preferredNationality;
            $job->job_type = $request->get('job_type');
            $job->employment_type = $request->get('employment_type');
            $job->gender_type = $request->get('gender_type');
            $job->country_id = $request->get('country_id');
            $job->state_id = $request->get('state_id');
            $job->visa = $visa;
            $job->apply = $request->get('apply_url');
            $job->industry = $request->get('industry');
            $job->company_id = $request->get('company');

            if (Auth::user()->hasRole(['admin','su'])) {
                $job->active_flag = 1;
            } else {
                $job->active_flag = 2;
            }

            if ($request->get('walkin') == 1) {
                $job->walkin = 1;
            }

            $job->save();

            return back()->with('success', ['Job saved']);
        } catch (Exception $e) {
            return back()->withErrors([$e]);
        }
    }

    /**
     * Load state list.
     *
     * @return Response
     */
    public function loadCountryRelatedData($country = null)
    {
        $html = "";
        if ($country != null) {
            $states = State::where('country_id', $country)->get();
        } else {
            $states = State::all();
        }
        $html .= '<option value="" selected>Select state</option>';
        $html .= '<option value="0">Not Required</option>';
        foreach ($states as $s) {
            $html .= '<option value="'.$s->id.'">'.$s->state.'</option>';
        }

        $data['states'] = $html;

        $html2 = "";
        if ($country != null) {
            $visas = Visa::where('country_id', $country)->get();
        } else {
            $visas = Visa::all();
        }
        $html2 .= '<option value="" selected>Select visa</option>';
        $html2 .= '<option value="0">Not required</option>';
        foreach ($visas as $v) {
            $html2 .= '<option value="'.$v->visa.'">'.$v->visa.'</option>';
        }

        $data['visas'] = $html2;

        return $data;
    }

    public function updateJobStatus($job = null)
    {
        if ($job != null) {
            try {
                $job = JobPosting::find($job);
                if ($job->active_flag == 0) {
                    $job->active_flag = 2;
                    $job->save();
                    $success = [$job->title.' set for review'];
                    return back()->with('success', $success);
                } elseif ($job->active_flag == 2) {
                    $job->active_flag = 1;
                    $job->save();
                    $success = [$job->title.' activated'];
                    return back()->with('success', $success);
                } elseif ($job->active_flag == 1) {
                    $job->active_flag = 0;
                    $job->save();
                    $success = [$job->title.' deactivated'];
                    return back()->with('success', $success);
                } else {
                    return back()->withErrors(['Status configuration unknown. Irrecoverable error']);
                }
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        }
    }

    public function bulkJobActivate($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->active_flag = 1;
            $job->save();
        }

        return back();
    }

    public function bulkJobDeactivate($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->active_flag = 0;
            $job->save();
        }

        return back();
    }

    public function bulkJobReview($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->active_flag = 2;
            $job->save();
        }

        return back();
    }

    public function bulkJobDelete($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->delete();
        }

        return back();
    }



    public function deleteJobPosting($job = null)
    {
        if ($job != null) {
            try {
                $job = JobPosting::find($job);
                $success = ['Deleted job posting : '.$job->title];
                $job->delete();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        }
    }
}
