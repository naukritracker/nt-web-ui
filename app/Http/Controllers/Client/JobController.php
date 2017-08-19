<?php

namespace App\Http\Controllers\Client;

use App\Models\JobPostingHasApplication;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\Visa;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Helpers\Contracts\FormBuilderContract as FormBuilder;
use Redirect;
use Validator;

class JobController extends Controller
{

    /**
     * Show job search.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\View\View
     */





    public function showSearchJobs(Request $request, $country = null, $state = null)
    {
        $jobposting = new JobPosting;
        $order = ($request->input('order') != '') ? $request->input('order') : 'updated_at';
        if ($country != null) {
            if ('all-gulf-countries' == $country) {
                $countrydata = Country::whereIn(
                    'slug',
                    ['united-arab-emirates', 'saudi-arabia', 'oman', 'qatar', 'kuwait', 'bahrain']
                )->get();
            } else {
                $countrydata = Country::where('slug', $country)->get();
            }
            $jobposting->where(function ($query) use ($countrydata) {
                if (count($countrydata)) {
                    foreach ($countrydata as $country) {
                        $query->orWhere('country_id', $country->id);
                    }
                }
            });
            if ($state != null) {
                $statedata = State::where('slug', $state)->first();
                $jobposting->where('state_id', $statedata->id);
            }
            $jobs = $jobposting->where('active_flag', 1)->orderBy($order, 'desc')->paginate(10);
        } else {
            $jobs = $jobposting->where('active_flag', 1)->orderBy($order, 'desc')->paginate(10);
        }
        if ($request->ajax()) {
            return json($jobs);
        } else {
            $availablejobs = JobPosting::where('active_flag', 1)->count();
            $data['jobs'] = $jobs;
            return view('client.jobsearch')->with('data', $data)
                ->with('availablejobs', $availablejobs)
                ->with('order', $order);
        }



    }

    /**
     * Load search jobs filter data.
     *
     * @param Request $request
     *
     * @return array
     *
     */
    public function loadFilterData(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
            $data = [];
            $highestoffered = JobPosting::where('active_flag', 1)->max('salary_range_end');
            $lowestoffered = JobPosting::where('active_flag', 1)->min('salary_range_start');

            $data['locations'] = $formbuilder->build('AvailableLocationsListing');
            $data['industry'] = $formbuilder->build('AvailableIndustryListing');
            $data['companies'] = $formbuilder->build('AvailableCompaniesListing');
            $data['rangehighest'] = $highestoffered;
            $data['rangelowest'] = $lowestoffered;

            return $data;
        } else {
            return [];
        }
    }


    /**
     * Search jobs result.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function searchJobs(Request $request)
    {
        // $this->validate($request,[
        //     'search_value' => 'required',
        //     ]);

        $order = $request->input('order');
        if ($order == '') {
            $order = 'updated_at';
        }


        $search_value = $request->input('search_value');
        $locations = $request->input('location_list');
        if ($locations != '') {
            $locationArr = explode(';;;;', $locations);
            if (in_array('0', $locationArr)) {
                $locationArr = [];
            }
        } else {
            $locationArr = [];
        }


        $industries = $request->input('industry_list');
        if ($industries != '') {
            $industriesArr = explode(';;;;', $industries);
        } else {
            $industriesArr = [];
        }

        $companies = $request->input('company_list');
        if ($companies != '') {
            $companiesArr = explode(';;;;', $companies);
        } else {
            $companiesArr = [];
        }

        $salarylowest = $request->input('salary_start');
        $salaryhighest = $request->input('salary_end');
        $salarylow = $request->input('salary_range_start');
        $salaryhigh = $request->input('salary_range_end');

        $walkin = $request->input('walkin');

        $query = JobPosting::where('active_flag', '=', '1')
            ->where(function ($query) use ($locationArr) {
                if (count($locationArr)>0) {
                    foreach ($locationArr as $l) {
                        $query->orWhere('state_id', '=', $l);
                    }
                }
            })
            ->where(function ($query) use ($industriesArr) {
                if (count($industriesArr)>0) {
                    foreach ($industriesArr as $i) {
                        $query->orWhere('industry', 'like', '%'.$i.'%');
                    }
                }
            })
            ->where(function ($query) use ($salaryhigh, $salarylow) {
                if ($salaryhigh != '') {
                    $query->whereBetween('salary_range_start', [$salarylow,$salaryhigh]);
                    $query->orWhereBetween('salary_range_end', [$salarylow,$salaryhigh]);
                }
            })
            ->where(function ($query) use ($companiesArr) {
                if (count($companiesArr)>0) {
                    foreach ($companiesArr as $c) {
                        $query->orWhere('company_id', '=', $c);
                    }
                }
            })
            ->where(function ($query) use ($search_value, $request) {
                if ($request->has('search_value')) {
                    $query->orWhere('title', 'like', '%'.$search_value.'%')
                        ->orWhere('description', 'like', '%'.$search_value.'%')
                        ->orWhere('requirements', 'like', '%'.$search_value.'%')
                        ->orWhere('industry', 'like', '%'.$search_value.'%')
                        ->orWhereHas('state', function ($query) use ($search_value) {
                            $query->where('state.state', 'like', '%'.$search_value.'%');
                        })
                        ->orWhereHas('country', function ($query) use ($search_value) {
                            $query->where('country.country', 'like', '%'.$search_value.'%');
                        });
                    if (ctype_digit($search_value)) {
                        $query->orWhere('minimum_experience', '>=', $search_value)
                            ->orWhere('salary_range_start', '>=', $search_value)
                            ->orWhere('salary_range_end', '<=', $search_value);
                    }
                }
            })
            ->where(function ($query) use ($search_value, $request) {
                if ($request->has('visa_type')) {
                    $query->where('visa', 'like', '%'.$request->get('visa_type').'%');
                }
                if ($request->has('experience')) {
                    $query->where('minimum_experience', '>=', $request->get('experience'));
                }
                if ($request->has('state_id')) {
                    $query->where('state_id', $request->get('state_id'));
                }
                if ($request->has('functional_area')) {
                    $query->where('role', 'like', $request->get('functional_area'));
                }
            })
            ->where(function ($query) use ($walkin, $request) {
                if ($request->has('walkin') && $request->get('walkin') == '1') {
                    $query->orWhere('walkin', $request->get('walkin'));
                }
            });

        $data['jobs'] = $query->orderBy($order, 'desc')
            ->paginate(10);


        return view('client.jobsearch')->with('data', $data)
            ->with('search_value', $search_value)
            ->with('location_list', $locations)
            ->with('industry_list', $industries)
            ->with('salary_start', $salarylowest)
            ->with('salary_end', $salaryhighest)
            ->with('salary_range_start', $salarylow)
            ->with('salary_range_end', $salaryhigh)
            ->with('company_list', $companies)
            ->with('walkin', $walkin)
            ->with('order', $order);
    }

    /**
     * Show job details.
     *
     * @param  Request  $request
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showJobDetails(Request $request, $id)
    {
        if ($request->ajax()) {
            return false;
        } else {
            $data['job'] = JobPosting::find($id);
            return view('client.jobdetails')->with('data', $data);
        }
    }
    /**
     * Load job posting form
     *
     * @param Request $request
     * @param FormBuilder $formbuilder
     *
     * @return bool
     */
    public function loadEmployerPostAJob(Request $request, FormBuilder $formbuilder, $id = null, $type = null)
    {
        $form = false;
        if ($request->ajax()) {
            $form = $formbuilder->build('EmployerPostAJob', ['id' => $id, 'type' => $type]);
        }
        return $form;
    }
    /**
     * Load state list.
     *
     * @return Response
     */
    public function loadCountryRelatedData($country = null, $job = null)
    {
        $html = "";
        if ($job) {
            $jobposting = JobPosting::find($job);
        } else {
            $jobposting = null;
        }

        if ($country != null) {
            $states = State::where('country_id', $country)->get();
        } else {
            $states = State::all();
        }
        $html .= '<option value="" selected>Select state</option>';
        $html .= '<option value="0">Not Specified</option>';
        foreach ($states as $s) {
            if ($jobposting and $s->id == $jobposting->state_id) {
                $html .= '<option value="'.$s->id.'" selected="selected">'.$s->state.'</option>';
            } else {
                $html .= '<option value="' . $s->id . '">' . $s->state . '</option>';
            }
        }

        $data['states'] = $html;

        $html2 = "";
        if ($country != null) {
            $visas = Visa::where('country_id', $country)->get();
        } else {
            $visas = Visa::all();
        }
        if ($jobposting) {
            $html2 .= '<option value="">Select visa</option>';
        } else {
            $html2 .= '<option value="" selected>Select visa</option>';
        }
        $html2 .= '<option value="0">Not required</option>';
        foreach ($visas as $v) {
            if ($jobposting and strpos($jobposting->visa, $v->visa) !== false) {
                $html2 .= '<option value="'.$v->visa.'" selected="selected">'.$v->visa.'</option>';
            } else {
                $html2 .= '<option value="'.$v->visa.'">'.$v->visa.'</option>';
            }
        }

        $data['visas'] = $html2;

        return $data;
    }

    public function doEmployersPostAJob(Request $request, $id=null)
    {
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
                $job->modified_user_id = Auth::user("employer")->id;
                $job->updated_at = date('Y-m-d H:i:s');
            } else {
                $job = new JobPosting;
                $job->user_id = Auth::user("employer")->id;
                $job->modified_user_id = Auth::user("employer")->id;
                $job->created_at = date('Y-m-d H:i:s');
                $job->updated_at = date('Y-m-d H:i:s');
            }
            $workLocations = '';
            if ($request->has('work_locations')) {
                if (is_array($request->get('work_locations'))) {
                    $workLocations = implode('||',$request->get('work_locations'));
                } else {
                    $workLocations = $request->get('work_locations');
                }
            }
            $visa = '';
            if ($request->has('visa')) {
                if (is_array($request->get('visa'))) {
                    $visa = implode('||',$request->get('visa'));
                } else {
                    $visa = $request->get('visa');
                }
            }
            $preferredNationality = 0;
            if ($request->has('preferred_nationality')) {
                if (is_array($request->get('preferred_nationality'))) {
                    $preferredNationality = implode('||',$request->get('preferred_nationality'));
                } else {
                    $preferredNationality= $request->get('preferred_nationality');
                }
            }

            $job->title = $request->get('title');
            $job->posted_by_employer = 1;
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
            $job->active_flag = 2;

            if ($request->get('walkin') == 1) {
                $job->walkin = 1;
            }

            if ($job->save()) {
                return back()->with('success', ['Job saved']);
            } else {
                return back()->withErrors(['Failed to save Job']);
            }


        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
    public function deleteEmployerJobPosting($id = null)
    {
        if ($id) {
            $job = JobPosting::find($id);
            if (Auth::user('employer')->id == $job->user_id) {
                if($job->delete()) {
                    return back()->with('success', ['Deleted job successfully']);
                } else {
                    return back()->withErrors(['Failed to delete job']);
                }
            }
        } else {
            return back()->withErrors(['Failed to delete job']);
        }
    }
    public function registerJobApplication($id, $url)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $application = JobPostingHasApplication::where('user_id', $user->id)->where('jobposting_id', $id)->first();
            if ($application) {
                $application->count = $application->count + 1;
            } else {
                $application = new JobPostingHasApplication();
                $application->user_id = $user->id;
                $application->jobposting_id = $id;
                $application->count = 1;
            }
            $application->save();
            return Redirect::to($url);
        } else if (Auth::user('employer')) {
            return back()->withErrors(['Restricted Operation']);
        }
    }
}
