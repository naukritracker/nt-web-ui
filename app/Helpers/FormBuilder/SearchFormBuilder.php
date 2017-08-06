<?php

namespace App\Helpers\FormBuilder;

use App\Models\EmployerUser;
use App\Models\JobPosting;
use App\Models\UserDetail;
use App\User;

class SearchFormBuilder extends CommonFormBuilder
{
    /**
     * Home Page - Search Form
     */
    public function buildHomeSearchForm()
    {
        //$visajobs = JobPosting::select('visa')->where('active_flag','1')->distinct()->get();
        $visajobs = JobPosting::where('jobposting.active_flag', 1)->get();
        $selectvisa = array();

        foreach ($visajobs as $visa) {
            if ($visa->visa) {
                $visaarray = explode('||', $visa->visa);
                if (count($visaarray)) {
                    foreach ($visaarray as $vs) {
                        if (!array_key_exists($vs, $selectvisa) and $vs != "") {
                            if ('0' === $vs) {
                                $selectvisa[$vs] = 'Not Required';
                            } else {
                                $selectvisa[$vs] = $vs;
                            }
                        }
                    }
                }
            }
        }

        $selectexp = array();
        for ($i=0; $i < 65; $i++) {
            $selectexp[$i] = $i.'+ ';
            if ($i > 1) {
                $selectexp[$i] .= 'years';
            } else {
                $selectexp[$i] .= 'year';
            }
        }

        $selectstate = array();
        $statejobs = JobPosting::select('state_id')->where('active_flag', '1')->distinct()->get();
        foreach ($statejobs as $job) {
            if ($job->state) {
                $selectstate[$job->state_id] = $job->state->state.' ('.$job->state->country->country.')';
            }
        }

        $rolejobs = JobPosting::select('role')->where('active_flag', '1')
            ->groupBy('role')
            ->distinct()
            ->get();
        $selectfunctionalarea = array();
        foreach ($rolejobs as $job) {
            $selectfunctionalarea[$job->role] = $job->role;
        }
        return view('forms.homesearch')->with('selectfunctionalarea', $selectfunctionalarea)
                                        ->with('selectvisa', $selectvisa)
                                        ->with('selectexp', $selectexp)
                                        ->with('selectstate', $selectstate)
                                        ->render();
    }

    /**
     * Build list of available locations
     *
     * @return \Illuminate\View\View
     */
    public function buildAvailableLocationsListing()
    {
        $statejobs = JobPosting::select('state_id')->where('active_flag', 1)->distinct()->get();
        return view('forms.availablelocationslisting')->with('statejobs', $statejobs)->render();
    }

    /**
     * Build list of available industries
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buildAvailableIndustryListing()
    {
        $industryjobs = JobPosting::select('industry')->where('active_flag', 1)->distinct()->get();
        return view('forms.availableindustrylisting')->with('industryjobs', $industryjobs)->render();
    }

    /**
     * Build list of available companies
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buildAvailableCompaniesListing()
    {
        $companiesjob = JobPosting::select('company_id')->where('active_flag', 1)->distinct()->get();
        return view('forms.availablecompanieslisting')->with('companiesjob', $companiesjob)->render();
    }
}
