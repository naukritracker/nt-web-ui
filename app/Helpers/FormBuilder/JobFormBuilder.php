<?php

namespace App\Helpers\FormBuilder;

use App\Models\Country;
use App\Models\JobPosting;
use App\Models\State;
use App\Models\Industry;
use App\Models\Company;

class JobFormBuilder
{
    public function buildEmployerPostAJob($id, $type)
    {
        $html = "";
        $countries = Country::all();
        $selectcountry = array();
        foreach ($countries as $c) {
            $selectcountry[$c->id] = $c->country;
        }

        $selectstate = array();
        $selectstate[0] = 'Not Specified';

        $selectindustry = array();
        $industries = Industry::orderBy('industry')->get();
        foreach ($industries as $i) {
            $selectindustry[$i->industry] = $i->industry;
        }

        $companies = Company::all();
        $selectcompany = array();
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

        if ($id != null) {
            $job = JobPosting::find($id);
        } else {
            $job = null;
        }

        return view('forms.employerpostajob')->with('job', $job)
            ->with('formtype', $type)
            ->with('selectcountry', $selectcountry)
            ->with('selectstate', $selectcountry)
            ->with('selectindustry', $selectindustry)
            ->with('selectcompany', $selectcompany)
            ->with('selectstatesall', $selectstatesall)
            ->with('minimum_education', $minimum_education)
            ->with('minimum_experience', $minimum_experience)
            ->with('selectemploymenttype', $selectemploymenttype)
            ->with('selectjobtype', $selectjobtype)
            ->with('selectgendertype', $selectgendertype);
    }
}