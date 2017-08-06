<?php

namespace App\Http\Controllers\Client;

use Auth;
use App\Helpers\FormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\UserDetail;
use App\User;
use Illuminate\Http\Request;
use App\Models\Country;

class EmployerController extends Controller
{

    /**
     * Show homepage.
     *
     * @return \Illuminate\View\View
     */
    public function showEmployers()
    {
        $allcountries = Country::all();
        $countries = array();
        foreach ($allcountries as $country) {
            $countries[$country->id] = $country->country;
        }
        return view('client.employers')->with('countries', $countries);
    }

    /**
     * Show employers banner
     *
     * @param  Request  $request
     *
     * @return \Illuminate\View\View|int
     */
    public function loadEmployersBanner(Request $request)
    {
        if ($request->ajax()) {
            return view('client.partials.employerbanner');
        } else {
            return -1;
        }
    }
    /**
     * Show employer profile
     */
    public function showProfile()
    {
        $data = array();
        return view('client.employerprofile')->with('data', $data);
    }
    /**
     * Load employer profile form
     */
    public function loadProfileForm(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
            $form = $formbuilder->build('EmployerProfile');
            return $form;
        } else {
            return -1;
        }
    }
    /**
     * Load post a job form
     *
     * @param Request $request
     * @param FormBuilder $formbuilder
     *
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function loadEmployerPostAJob(Request $request, FormBuilder $formbuilder)
    {
        $form = false;
        if ($request->ajax()) {
            $form = $formbuilder->build('EmployerPostAJob');
        }
        return $form;
    }
    /**
     * Post a job from employer
     *
     * @param Request $request
     * @param null $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function doEmployersPostAJob(Request $request, $id=null)
    {
        // TODO : Set up column in DB to identify user
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
                $job->modified_user_id = Auth::user('employer')->id;
                $job->updated_at = date('Y-m-d H:i:s');
            } else {
                $job = new JobPosting;
                $job->user_id = Auth::user('employer')->id;
                $job->modified_user_id = Auth::user('employer')->id;
                $job->created_at = date('Y-m-d H:i:s');
                $job->updated_at = date('Y-m-d H:i:s');
            }

            $job->title = $request->get('title');
            $job->short_description = $request->get('short_description');
            $job->description = $request->get('description');
            $job->requirements = $request->get('requirements');
            $job->role = $request->get('role');
            $job->open_positions = $request->get('open_positions');
            $job->minimum_education = $request->get('minimum_education');
            $job->minimum_experience = $request->get('minimum_experience');
            $job->job_locations = implode("||", $request->get('work_locations'));
            $job->salary_range_start = $request->get('salary_range_start');
            $job->salary_range_end = $request->get('salary_range_end');
            $job->preferred_nationality = $request->has('preferred_nationality') ? implode("||", $request->get('preferred_nationality')) : '';
            $job->job_type = $request->get('job_type');
            $job->employment_type = $request->get('employment_type');
            $job->gender_type = $request->get('gender_type');
            $job->country_id = $request->get('country_id');
            $job->state_id = $request->get('state_id');
            $job->visa = implode("||", $request->get('visa'));
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
            $job->posted_by_employer = 1;
            if ($job->save()) {
                return back()->with('success', ['Job saved']);
            } else {
                return back()->withErrors(['Failed to save Job']);
            }
        } catch (Exception $e) {
            return back()->withErrors([$e]);
        }
    }

    /**
     * Show job posting
     *
     * @param  Request  $request
     *
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showJobPosting(Request $request)
    {
        if ($request->ajax()) {
            return false;
        } else {
            return view('client.employerjobposting');
        }
    }

    public function viewJobApplicants()
    {
        return view('client.employerapplicants');
    }
    public function viewPostedJobs()
    {
        return view('client.employerpostedjobs');
    }
}
