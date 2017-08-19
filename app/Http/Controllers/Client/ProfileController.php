<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\EmployerUserDetails;
use Html;
use Auth;
use File;
use URL;
use Validator;
use Hash;
use App\User;
use App\Models\Company;
use App\Models\Country;
use App\Models\Experience;
use App\Models\Media;
use App\Models\UserDetail;
use App\Models\FunctionalArea;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Helpers\Contracts\FormBuilderContract as FormBuilder;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Show profile page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showProfile(Request $request)
    {
        $companies = Company::all();
        $selectcompanies = array();
        foreach ($companies as $c) {
            $selectcompanies[$c->id] = $c->name;
        }
        $selectcompanies['ot'] = 'Other';

        $annual_lakh_options = array();
        for ($i=0; $i<=99; $i++) {
            array_push($annual_lakh_options, $i);
        }

        $annual_thousand_options = array();
        for ($i=0; $i<100; $i++) {
            array_push($annual_thousand_options, $i);
        }

        $selectcountries = array();
        $countries = Country::all();
        foreach ($countries as $c) {
            $selectcountries[$c->id] = $c->country;
        }

        $selectindustry = array();
        $industries = Industry::orderBy('industry')->get();
        foreach ($industries as $i) {
            $selectindustry[$i->id] = $i->industry;
        }

        $selectfunctionalarea = array();
        $functionalareas = FunctionalArea::orderBy('functional_area')->get();
        foreach ($functionalareas as $f) {
            $selectfunctionalarea[$f->id] = $f->functional_area;
        }

        if (Auth::user('employer')) {
            $view = view('client.employerprofile')->with('selectcompanies', $selectcompanies)
                ->with('annual_lakh_options', $annual_lakh_options)
                ->with('annual_thousand_options', $annual_thousand_options)
                ->with('countries', $selectcountries)
                ->with('selectindustry', $selectindustry)
                ->with('selectfunctionalarea', $selectfunctionalarea);

        } else {
            $view = view('client.profile')->with('selectcompanies', $selectcompanies)
                ->with('annual_lakh_options', $annual_lakh_options)
                ->with('annual_thousand_options', $annual_thousand_options)
                ->with('countries', $selectcountries)
                ->with('selectindustry', $selectindustry)
                ->with('selectfunctionalarea', $selectfunctionalarea);

        }

        return $view;
    }

    public static function _escapeUserDetail($userdetail)
    {
        $returnArray = [];

        if (isset($userdetail->first_name)) {
            $returnArray['first_name'] = $userdetail->first_name;
        } else {
            $returnArray['first_name'] = null;
        }

        if (isset($userdetail->last_name)) {
            $returnArray['last_name'] = $userdetail->last_name;
        } else {
            $returnArray['last_name'] = null;
        }

        if (isset($userdetail->profile_headline)) {
            $returnArray['profile_headline'] = $userdetail->profile_headline;
        } else {
            $returnArray['profile_headline'] = null;
        }

        if (isset($userdetail->country_code)) {
            $returnArray['country_code'] = $userdetail->country_code;
        } else {
            $returnArray['country_code'] = null;
        }

        if (isset($userdetail->contact_no)) {
            $returnArray['contact_no'] = $userdetail->contact_no;
        } else {
            $returnArray['contact_no'] = null;
        }

        if (isset($userdetail->current_location)) {
            $returnArray['current_location'] = $userdetail->current_location;
        } else {
            $returnArray['current_location'] = null;
        }

        if (isset($userdetail->preferred_location)) {
            $returnArray['preferred_location'] = $userdetail->preferred_location;
        } else {
            $returnArray['preferred_location'] = null;
        }

        if (isset($userdetail->industry)) {
            $returnArray['industry'] = $userdetail->industry;
        } else {
            $returnArray['industry'] = null;
        }

        if (isset($userdetail->functional_area)) {
            $returnArray['functional_area'] = $userdetail->functional_area;
        } else {
            $returnArray['functional_area'] = null;
        }

        if (isset($userdetail->role)) {
            $returnArray['role'] = $userdetail->role;
        } else {
            $returnArray['role'] = null;
        }

        if (isset($userdetail->dob_day)) {
            $returnArray['dob_day'] = $userdetail->dob_day;
        } else {
            $returnArray['dob_day'] = null;
        }

        if (isset($userdetail->dob_month)) {
            $returnArray['dob_month'] = $userdetail->dob_month;
        } else {
            $returnArray['dob_month'] = null;
        }
        if (isset($userdetail->dob_year)) {
            $returnArray['dob_year'] = $userdetail->dob_year;
        } else {
            $returnArray['dob_year'] = null;
        }

        if (isset($userdetail->gender)) {
            $returnArray['gender'] = $userdetail->gender;
        } else {
            $returnArray['gender'] = null;
        }

        if (isset($userdetail->marital_status)) {
            $returnArray['marital_status'] = $userdetail->marital_status;
        } else {
            $returnArray['marital_status'] = null;
        }

        if (isset($userdetail->city)) {
            $returnArray['city']= $userdetail->city;
        } else {
            $returnArray['city'] = null;
        }

        if (isset($userdetail->profile_image)) {
            $returnArray['profile_image']= $userdetail->profile_image;
        } else {
            $returnArray['profile_image'] = null;
        }

        if (isset($userdetail->sse_institution)) {
            $returnArray['sse_institution']= $userdetail->sse_institution;
        } else {
            $returnArray['sse_institution'] = null;
        }

        if (isset($userdetail->sse_start_date)) {
            $returnArray['sse_start_date']= $userdetail->sse_start_date;
        } else {
            $returnArray['sse_start_date'] = null;
        }

        if (isset($userdetail->sse_end_date)) {
            $returnArray['sse_end_date']= $userdetail->sse_start_date;
        } else {
            $returnArray['sse_end_date'] = null;
        }

        if (isset($userdetail->sse_type)) {
            $returnArray['sse_type']= $userdetail->sse_type;
        } else {
            $returnArray['sse_type'] = null;
        }


        if (isset($userdetail->hsse_institution)) {
            $returnArray['hsse_institution']= $userdetail->hsse_institution;
        } else {
            $returnArray['hsse_institution'] = null;
        }

        if (isset($userdetail->hsse_start_date)) {
            $returnArray['hsse_start_date']= $userdetail->hsse_start_date;
        } else {
            $returnArray['hsse_start_date'] = null;
        }

        if (isset($userdetail->hsse_end_date)) {
            $returnArray['hsse_end_date']= $userdetail->hsse_start_date;
        } else {
            $returnArray['hsse_end_date'] = null;
        }

        if (isset($userdetail->hsse_type)) {
            $returnArray['hsse_type']= $userdetail->hsse_type;
        } else {
            $returnArray['hsse_type'] = null;
        }

        if (isset($userdetail->ug_institution)) {
            $returnArray['ug_institution']= $userdetail->ug_institution;
        } else {
            $returnArray['ug_institution'] = null;
        }

        if (isset($userdetail->ug_start_date)) {
            $returnArray['ug_start_date']= $userdetail->ug_start_date;
        } else {
            $returnArray['ug_start_date'] = null;
        }

        if (isset($userdetail->ug_end_date)) {
            $returnArray['ug_end_date']= $userdetail->ug_start_date;
        } else {
            $returnArray['ug_end_date'] = null;
        }

        if (isset($userdetail->ug_type)) {
            $returnArray['ug_type']= $userdetail->ug_type;
        } else {
            $returnArray['ug_type'] = null;
        }

        if (isset($userdetail->pg_institution)) {
            $returnArray['pg_institution']= $userdetail->pg_institution;
        } else {
            $returnArray['pg_institution'] = null;
        }

        if (isset($userdetail->pg_start_date)) {
            $returnArray['pg_start_date']= $userdetail->pg_start_date;
        } else {
            $returnArray['pg_start_date'] = null;
        }

        if (isset($userdetail->pg_end_date)) {
            $returnArray['pg_end_date']= $userdetail->pg_start_date;
        } else {
            $returnArray['pg_end_date'] = null;
        }

        if (isset($userdetail->pg_type)) {
            $returnArray['pg_type']= $userdetail->pg_type;
        } else {
            $returnArray['pg_type'] = null;
        }

        if (isset($userdetail->other_institution)) {
            $returnArray['other_institution']= $userdetail->other_institution;
        } else {
            $returnArray['other_institution'] = null;
        }

        if (isset($userdetail->other_start_date)) {
            $returnArray['other_start_date']= $userdetail->other_start_date;
        } else {
            $returnArray['other_start_date'] = null;
        }

        if (isset($userdetail->other_end_date)) {
            $returnArray['other_end_date']= $userdetail->other_start_date;
        } else {
            $returnArray['other_end_date'] = null;
        }

        if (isset($userdetail->other_type)) {
            $returnArray['other_type']= $userdetail->other_type;
        } else {
            $returnArray['other_type'] = null;
        }

        return (object) $returnArray;
    }

    /**
     * Load edit resume section.
     *
     * @param  Request  $request
     * @return Response
     */
    public function loadResumeEditor(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
            $form = $formbuilder->build('SaveProfile');
            return $form;
        } else {
            return -1;
        }
    }

    public function loadProfileSummary(Request $request)
    {
        if ($request->ajax()) {
            $html = '';

            $totalexp = 0;

            $userdetail = self::_escapeUserDetail(Auth::user()->userdetail);

            foreach (Auth::user()->experience as $exp) {
                $totalexp = $totalexp + $exp->total_experience;
            }

            $html .= '<div class="row" style="word-wrap: break-word;">
            <div class="col-sm-12">
            <div class="form-group">
                <label for=""><b>Profile Headline</b> </label>
                <p>';
            if (Auth::user()->userdetail->profile_headline != '') {
                $html .= Auth::user()->userdetail->profile_headline;
            } else {
                $html .= 'No headline specified';
            }
            $html .= '</p>
                </div>
                </div>
                </div>';
            $html .= ' <div class="clearfix">
                            <div class="row">
                                <div class="col-sm-3">
                                    ';
            if (Auth::user()->userdetail->profile_image != '') {
                $path = public_path().'/uploads/profile/'.Auth::user()->userdetail->profile_image;
                if (file_exists($path)) {
                    $html .= Html::image('uploads/profile/'.Auth::user()->userdetail->profile_image, Auth::user()->name, ['class'=>'img-responsive','id'=>'profile_image']);
                } else {
                    $html .=  Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive','id'=>'profile_image']);
                }
            } else {
                $html .= Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive','id'=>'profile_image']);
            }


            $html .= '</div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for=""><b>Name</b></label>
                                <p>'.Auth::user()->name.'</p> 
                            </div>
                        </div>
                        <div class="clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""><b>Email Address</b> </label>
                                <p>'.Auth::user()->email.'</p>
                            </div>
                        </div>';
            if (isset(Auth::user()->userdetail->contact_no)) {
                $html .= '<div class="col-sm-6">
                    <div class="form-group">
                        <label for=""><b>Mobile Number</b> </label>
                        <p>'.Auth::user()->userdetail->contact_no.'</p>
                    </div>';
            }
            $html .= '</div>
                         </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for=""><b>Current Location</b> </label><p>';
            if (isset(Auth::user()->currentlocation)) {
                $html .= Auth::user()->currentlocation->state;
            } else {
                $html .= 'No current location specified';
            }

            $html .= '</p></div>
                      </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for=""><b>Preferred Location</b></label>
                                <p>';
            if (isset(Auth::user()->preferredlocation)) {
                $html .= Auth::user()->preferredlocation->state;
            } else {
                $html .= 'No preferred location specified';
            }
            $html .= '</p>
                                        </div>
                                    </div>
                                </div>';
            if (isset(Auth::user()->userdetail->role)) {
                $html .= '<div class="col-sm-6">
                    <div class="form-group">
                        <label for=""><b>Role</b> </label>
                        <p>';
                if (isset(Auth::user()->preferredlocation)) {
                    $html .= Auth::user()->userdetail->role;
                } else {
                    $html .= 'No role specified';
                }
                $html .= '</p>
                    </div>
                </div>';
            }

            if (isset(Auth::user()->userdetail->dob_day) && isset(Auth::user()->userdetail->dob_month)
                && isset(Auth::user()->userdetail->dob_year)
            ) {
                $html .= '<div class="col-sm-6">
                    <div class="form-group">
                        <label for=""><b>Date of Birth</b></label>
                        <p>'.Auth::user()->userdetail->dob_day.'/'.Auth::user()->userdetail->dob_month.'/'.Auth::user()->userdetail->dob_year.'</p>
                    </div>
                </div>';
            }


            if (isset(Auth::user()->userdetail->gender) and Auth::user()->userdetail->gender != "") {
                $html .= '<div class="col-sm-6">
                        <div class="form-group">
                            <label for=""><b>Gender</b></label>
                            <p>';
                if (isset(Auth::user()->userdetail->gender)) {
                    $html .= Auth::user()->userdetail->gender;
                } else {
                    $html .= 'No gender specified';
                }
                $html .= '</p>
                        </div>
                    </div>';
            }

            if (isset(Auth::user()->userdetail->permanent_address) and Auth::user()->userdetail->permanent_address != "") {
                $html .= '<div class="col-sm-12">
                    <div class="form-group">
                        <label for=""><b>Permanent Address</b></label>
                        <p>';
                if (isset(Auth::user()->userdetail->permanent_address)) {
                    $html .= Auth::user()->userdetail->permanent_address;
                } else {
                    $html .= 'No permanent status specified';
                }
                $html .= '</p>
                    </div>
                </div>';
            }

            if (isset(Auth::user()->userdetail->city) and Auth::user()->userdetail->city != "") {
                $html .= '<div class="col-sm-6">
                        <div class="form-group">
                            <label for=""><b>Home Town/City</b></label>
                            <p>';
                if (isset(Auth::user()->userdetail->city)) {
                    $html .= Auth::user()->userdetail->city;
                } else {
                    $html .= 'No city specified';
                }
                $html .= '</p>
                        </div>
                    </div>';
            }

            if (isset(Auth::user()->userdetail->industries)) {
                $html .= '<div class="col-sm-6">
                        <div class="form-group">
                            <label for=""><b>Industry </b></label>
                            <p>'. Auth::user()->userdetail->industries->industry .'</p>
                        </div>
                    </div>';
            }
            if (isset(Auth::user()->userdetail->functionalareas)) {
                $html .= '<div class="col-sm-6">
                        <div class="form-group">
                            <label for=""><b>Functional Area </b></label>
                            <p>'. Auth::user()->userdetail->functionalareas->functional_area .'</p>
                        </div>
                    </div>';
            }
            $html .= '</div></div>';
            return $html;
        } else {
            return -1;
        }
    }

    public function saveProfile(Request $request)
    {


        $this->validate(
            $request,
            [
                'email' => 'required|email|unique:users,email,'.Auth::user()->id,
                'contact_no' => 'required',//ERROR : JQUERY PASSES WHEN MAX VAL IS 10 BUT THIS VALIDATION DOESNT
                'first_name' => 'required',
                'last_name' => 'required',
                'city' => 'required',
                'current_location' => 'required',
                'load_image_field' => 'mimes:jpg,png,jpeg,gif|max:12000',
            ]
        );
        try {
            $user = User::find(Auth::user()->id);
            $user->email = $request->get('email');
            $user->userdetail->first_name = $request->get('first_name');
            $user->userdetail->last_name = $request->get('last_name');
            $user->name = $request->get('first_name').' '.$request->get('last_name');
            $user->userdetail->profile_headline = $request->get('profile_headline');
            $user->userdetail->contact_no = $request->get('contact_no');
            $user->userdetail->country_code = $request->get('country_code');
            $user->userdetail->current_location = $request->get('current_location');
            $user->userdetail->preferred_location = $request->get('preferred_location');
            $industry = ( $request->get('industry') != '' ? $request->get('industry') : NULL );
            $user->userdetail->industry = $industry;
            $user->userdetail->functional_area = ( $request->get('functional_area') != '' ? $request->get('functional_area') : NULL );
            $user->userdetail->role = $request->get('role');
            $user->userdetail->dob_day = $request->get('dob_day');
            $user->userdetail->dob_month = $request->get('dob_month');
            $user->userdetail->dob_year = $request->get('dob_year');
            $user->userdetail->gender = $request->get('gender');
            $user->userdetail->marital_status = $request->get('marital_status');
            $user->userdetail->permanent_address = $request->get('permanent_address');
            $user->userdetail->city = $request->get('city');
            if ($request->hasFile('load_image_field')) {
                $imageName = $user->userdetail->id . '.' . $request->file('load_image_field')->getClientOriginalExtension();
                try {
                    if (File::exists(public_path().'/uploads/profile/'.$imageName)) {
                        File::delete(public_path().'/uploads/profile/'.$imageName);
                    }

                    $request->file('load_image_field')->move(public_path().'/uploads/profile', $imageName);
                } catch (\Exception $e) {
                    return back()->withErrors([$e]);
                }
                $user->userdetail->profile_image = $imageName;
            }
            $user->push();

            return redirect()->route('Profile', ['#page=profileform']);

        } catch (\Exception $e) {
            //echo $e->getMessage(); exit;
            return back()->withErrors([$e]);
        }
    }

    public function uploadResume(Request $request)
    {
        $this->validate($request, [
            'profile_resume' => 'required|mimes:doc,docx,rtf,pdf|max:300',
        ]);

        if ($request->hasFile('profile_resume')) {
            if (isset(Auth::user()->userdetail->resume_media_id)
                && Auth::user()->userdetail->resume_media_id != 0
            ) {
                $media = Media::find(Auth::user()->userdetail->resume_media_id);
            } else {
                $media = new Media;
            }
            $userdetails = self::_escapeUserDetail(Auth::user()->userdetail);
            $medianame = strtolower($userdetails->first_name.''.$userdetails->last_name).'_'.Auth::user()->id.'_resume.' . $request->file('profile_resume')->getClientOriginalExtension();
            try {
                $request->file('profile_resume')->move(public_path().'/uploads/resume', $medianame);
                $media->content = $medianame;
                $pdf = new \App\Http\Controllers\Utility\PdfController(public_path().'/uploads/resume/'.$medianame);
                $media->raw = $pdf->decode();
                if ($media->save()) {
                    $userdetails = UserDetail::where('user_id', Auth::user()->id)->first();
                    $userdetails->resume_media_id = $media->id;
                    $userdetails->save();
                    return back();
                } else {
                    return back()->withErrors(['Unable to save resume']);
                }
            } catch (\Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No file recieved by server']);
        }
    }

    public function deleteResume($id = null)
    {
        if ($id) {
            $media = Media::find($id);
            $name = $media->content;
            if ($media->delete()) {
                $userdetail = UserDetail::where('resume_media_id', $id)->first();
                $userdetail->resume_media_id = 0;
                $userdetail->save();

                File::delete(public_path().'/uploads/resume/'.$name);

                return back()->with('success', ['Resume deleted']);
            } else {
                return back()->withErrors(['Unable to delete resume']);
            }
        } else {
            return back()->withErrors(['Invalid Option']);
        }
    }



    public function loadEmploymentDetails(Request $request)
    {
        if ($request->ajax()) {
            $html = "";
            $userdetail = self::_escapeUserDetail(Auth::user()->userdetail);
            $exps = Experience::where('user_id', Auth::user()->id)->get();
            if (count($exps) > 0) {
                $html .= '<div class="container-fluid">
                <button class="btn btn-sm btn-success" id="add-exp" data-toggle="modal" data-target="#my-popup">Add more Experience &nbsp;<i class="fa fa-plus-circle"></i></button>
                </div><br>';
                foreach ($exps as $exp) {
                    if ($exp->company) {
                        $html .= '<div class="panel panel-default">
                        <div class="panel-heading">
                        '.$exp->company->name.'
                        <a href="'.URL::route('DeleteExperience', [$exp->id]).'#page=employmentdetails" id="'.$exp->id.'" class="fa fa-times-circle error-text pull-right" title="Delete '.$exp->company->name.' experience"></a>
                        </div>';

                        $html .= '<div class="panel-body">';

                        if ($exp->state_id != 0) {
                            $html .='<div class="col-sm-6">
                            <div class="form-group">
                            <label for="location">Location</label>
                            <p>'.$exp->state->state.'('.$exp->state->country->country.')'.'</p>
                            </div>
                            </div>';
                        }

                        if (strtotime($exp->start_date) > 0) {
                            $html .= '<div class="col-sm-6">
                            <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <p>'.$exp->start_date->formatLocalized('%A %d %B %Y').'</p>
                            </div>
                            </div>';
                        }

                        if (strtotime($exp->end_date) > 0) {
                            $html .= '<div class="col-sm-6">
                            <div class="form-group">
                            <label for="end_date">End Date</label>
                            <p>'.$exp->end_date->formatLocalized('%A %d %B %Y').'</p>
                            </div>
                            </div>';
                        }

                        if ($exp->description) {
                            $html .= '<div class="col-sm-12">
                            <div class="form-group">
                            <label for="description">Description</label>
                            <p>'.$exp->description.'</p>
                            </div>
                            </div>';
                        }

                        if ($exp->annual_thousand == 0
                            and $exp->annual_lakh != 0
                        ) {
                            $html .= '<div class="col-sm-12">
                            <div class="form-group">
                            <label for="renumeration"></label>
                            <p>'.$exp->annual_lakh.' Lakh(s) ';
                            if ($exp->currency) {
                                $html .= ' in '.$exp->currency;
                            }
                            $html .= '</p></div>
                            </div>';
                        }
                        else if ($exp->annual_thousand != 0
                            and $exp->annual_lakh != 0
                        )
                        {
                            $html .= '<div class="col-sm-12">
                            <div class="form-group">
                            <label for="renumeration"></label>
                            <p>'.$exp->annual_lakh.' Lakh(s) '.$exp->annual_thousand.' Thousand(s)';
                            if ($exp->currency) {
                                $html .= ' in '.$exp->currency;
                            }
                            $html .= '</p></div>
                            </div>';

                        }



                        if ($exp->industry) {
                            $html .= '<div class="col-sm-6">
                            <div class="form-group">
                            <label for="industry">Industry</label>
                            <p>'.$exp->industries->industry.'</p>
                            </div>
                            </div>';
                        }


                        if ($exp->functional_area) {

                            $html .= '<div class="col-sm-6">
                            <div class="form-group">
                            <label for="functional_area">Functional Area</label>
                            <p>'.$exp->functional_area.'</p>
                            </div>
                            </div>';
                        }
                        if ($exp->role) {
                            $html .= '<div class="col-sm-6">
                            <div class="form-group">
                            <label for="role">Role</label>
                            <p>'.$exp->role.'</p>
                            </div>
                            </div>';
                        }
                    } else {
                        $html .= '<p class="text-center">Fresher</p>';
                    }

                    $html .= '</div></div>';
                }
            } else {
                $html .= '<div class="jumbotron">
                  <h1>Hello, '.$userdetail->first_name.'!</h1>
                  <p>There are many fields in life where you might be uniquely talented. Let us know so we can find you the dream job you have been looking for.</p>
                  <p> <button class="btn btn-sm btn-success" id="add-exp" data-toggle="modal" data-target="#my-popup">Tell us more about yourself &nbsp;<i class="fa fa-paint-brush"></i></button></p>
                </div>';
            }


            return $html;
        } else {
            return -1;
        }
    }

    public function addExperience(Request $request)
    {
        if ($request->ajax()) {
            $this->formerrorcode = -2;

            $validator = Validator::make($request->all(), [
                    'company' => 'required',
                    'experience_start_date' => 'required',
                    'experience_end_date' => 'required'
                ]);

            $validator->after(function ($validator) use ($request) {
                $company_id = $request->get('company');
                $start_date = $request->get('experience_start_date');
                $end_date = $request->get('experience_end_date');

                $count = Experience::where(function ($query) use ($start_date, $end_date) {
                    $query->where('start_date', '>=', $start_date);
                    $query->where('end_date', '<=', $end_date);
                })->orWhere(function ($query) use ($end_date) {
                    $query->where('start_date', '>=', $end_date);
                    $query->where('end_date', '<=', $end_date);
                })->orWhere(function ($query) use ($start_date, $end_date) {
                    $query->where('start_date', '<=', $start_date);
                    $query->where('end_date', '>=', $end_date);
                })->get()->count();

                if ($count > 0) {
                    $validator->errors()->add('company', 'This time period has already been filled once');
                    $this->formerrorcode = -3;
                }
            });

            if ($validator->fails()) {
                return $this->formerrorcode;
            } else {
                //Check if dates and company clash and return -2



                if ($request->get('company') != 0) {
                    $exp = new Experience;
                    $company = Company::find($request->get('company'));
                    $exp->company_id = $request->get('company');
                    $exp->state_id = $company->state_id;
                    $exp->user_id = Auth::user()->id;
                    $exp->start_date = $request->get('experience_start_date');
                    $exp->end_date = $request->get('experience_end_date');
                    $carbonStart = Carbon::createFromTimestamp(strtotime($request->get('experience_start_date')));
                    $carbonEnd = Carbon::createFromTimestamp(strtotime($request->get('experience_end_date')));
                    $exp->total_experience = $carbonEnd->diffInYears($carbonStart);
                    $exp->description = $request->get('employement_description');
                    $exp->annual_lakh = $request->has('annual_lakh') ? $request->get('annual_lakh') : 0;
                    $exp->annual_thousand = $request->has('annual_thousand') ? $request->get('annual_thousand') : 0;
                    $exp->currency = $request->get('currency');
                    $exp->industry = $request->get('industry');
                    $exp->functional_area = $request->get('functional_area');
                    $exp->role = $request->get('role');
                    $exp->save();
                }
                return 1;
            }
        } else {

            return -1;
        }
    }


    public function deleteExperience($id = null)
    {
        if ($id) {
            $exp = Experience::find($id);
            if ($exp->company) {
                $name = $exp->company->name;
            } else {
                $name = '';
            }
            if ($exp->delete()) {
                return back()->with('success', ['Deleted '.$name]);
            } else {
                return back()->withErrors(['Unable to delete experience']);
            }
        } else {
            return back()->withErrors(['Invalid Option']);
        }
    }

    public function loadEducationDetails(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
			$userdetail = self::_escapeUserDetail(Auth::user()->userdetail);
            $form = $formbuilder->build('SaveEducationDetails');
            return $form;
        } else {
            return -1;
        }
    }

   public function saveEducationDetails(Request $request){
        $userdetails = UserDetail::where('user_id',Auth::user()->id)->first();

        $userdetails->sse_institution = $request->get('10_educational_institute_name');
        $userdetails->sse_start_date = $request->get('10_education_start_date');
        $userdetails->sse_end_date = $request->get('10_education_end_date');
        $userdetails->sse_type = $request->get('10_course');
        // $userdetails->sse_marks = $request->get('10_marks');

        $userdetails->hsse_institution = $request->get('12_educational_institute_name');
        $userdetails->hsse_start_date = $request->get('12_education_start_date');
        $userdetails->hsse_end_date = $request->get('12_education_end_date');
        $userdetails->hsse_type = $request->get('12_course');
        // $userdetails->hsse_marks = $request->get('12_marks');

        $userdetails->ug_institution = $request->get('ug_educational_institute_name');
        $userdetails->ug_start_date = $request->get('ug_education_start_date');
        $userdetails->ug_end_date = $request->get('ug_education_end_date');
        $userdetails->ug_type = $request->get('ug_course');
        // $userdetails->ug_marks = $request->get('ug_marks');

        $userdetails->pg_institution = $request->get('pg_educational_institute_name');
        $userdetails->pg_start_date = $request->get('pg_education_start_date');
        $userdetails->pg_end_date = $request->get('pg_education_end_date');
        $userdetails->pg_type = $request->get('pg_course');
        // $userdetails->pg_marks = $request->get('pg_marks');

        $userdetails->other_institution = $request->get('other_educational_institute_name');
        $userdetails->other_start_date = $request->get('other_education_start_date');
        $userdetails->other_end_date = $request->get('other_education_end_date');
        $userdetails->other_type = $request->get('other_course');
        // $userdetails->other_marks = $request->get('other_marks');

        $userdetails->save();

        return redirect()->route('Profile',['#page=educationdetails']);
    }

    public function loadChangePassword(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
            $html = $formbuilder->build('SaveChangePassword');
            return $html;
        } else {
            return -1;
        }
    }

    public function saveChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {
            $check = Auth::validate([
                'email'    => Auth::user()->email,
                'password' => $request->get('old_password')
            ]);

            if (!$check) {
                $validator->errors()->add(
                    'old_password',
                    'Your current password is incorrect, please try again.'
                );
            }
        });

        if ($validator->fails()) {
            return redirect()->route('Profile', ['#page=changepassword'])
                ->withErrors($validator);
        } else {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->get('new_password'));
            if ($user->save()) {
                return redirect()->route('Profile', ['#page=changepassword'])->with('success', ['Password changed successfully']);
            } else {
                return redirect()->route('Profile', ['#page=changepassword'])
                ->withErrors(['Unable to save new password. Please try again.']);
            }
        }
    }

    public function saveEmployerProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'companyName' => 'required|unique:employers,name,' . Auth::user("employer")->employer->id,
            'companyEmail' => 'required|email|unique:employers,email,' . Auth::user("employer")->employer->id,
            'companyPhone' => 'required|min:10',
            'password' => array(
                    "min:8",
                    "confirmed",
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}/"
                )
            ],
            [
                'regex' => 'The password must contain at least one capital, one number and a symbol'
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('EmployerProfile')
                ->withErrors($validator);
        } else {
            $employer = Employer::find(Auth::user("employer")->employer->id);
            $employer->name = $request->get('companyName');
            $employer->phone = $request->get('companyPhone');
            $employer->email = $request->get('companyEmail');
            $employer->address = $request->get('companyAddress');

            $employerUser = Auth::user("employer");
            $employerUser->first_name = isset(explode(" ", $request->get('companyName'))[0]) ? explode(" ", $request->get('companyName'))[0] : $request->get('companyName');
            $employerUser->last_name = isset(explode(" ", $request->get('companyName'))[1]) ? explode(" ", $request->get('companyName'))[1] : $request->get('companyName');
            $employerUser->email = $request->get('companyEmail');

            $employerUserDetails = EmployerUserDetails::where('employer_user_id', Auth::user("employer")->id)->first();
            $employerUserDetails->contact_no = $request->get('companyPhone');
            $employerUserDetails->save();

            if ($request->has('oldPassword')) {
                if (Hash::check($request->get('oldPassword'), $employerUser->password)) {
                    if ($request->has('newPassword')) {
                        if ($request->get('newPassword') === $request->get('newPassword_confirmation')) {
                            $employerUser->password = Hash::make($request->get('newPassword'));
                        } else {
                            return redirect()->route('EmployerProfile')
                                ->withErrors(['Passwords do not match. Please try again']);
                        }
                    } else {
                        return redirect()->route('EmployerProfile')
                            ->withErrors(['Failed to set an empty password']);
                    }
                } else {
                    return redirect()->route('EmployerProfile')
                        ->withErrors(['Old password does not match. Please try again']);
                }
            }

            if ($employer->save() and $employerUser->save()) {
                return redirect()->route('EmployerProfile')->with('success', ['Details updated successfully']);
            } else {
                return redirect()->route('EmployerProfile')
                    ->withErrors(['Unable to save details. Please try again']);
            }
        }
    }

    public function saveEmployerPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employerPhoto' => 'mimes:jpg,png,jpeg,gif|max:12000'
        ]);

        if ($validator->fails()) {
            return false;
        } else {
            if ($request->hasFile('employerPhoto')) {
                $employer = Auth::user('employer');
                $imageName = $employer->details->id . '_employer.' . $request->file('employerPhoto')->getClientOriginalExtension();
                try {
                    if (File::exists(public_path().'/uploads/profile/'.$imageName)) {
                        File::delete(public_path().'/uploads/profile/'.$imageName);
                    }
                    $request->file('employerPhoto')->move(public_path().'/uploads/profile', $imageName);
                } catch (\Exception $e) {
                    return false;
                }
                $employer->details->profile_image = $imageName;
                if($employer->push()) {
                    $path = public_path().'/uploads/profile/' . $imageName;
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    return $base64;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}

