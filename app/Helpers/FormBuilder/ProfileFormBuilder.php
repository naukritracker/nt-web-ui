<?php

namespace App\Helpers\FormBuilder;

use Auth;
use App\Models\FunctionalArea;
use App\Models\Industry;
use App\Models\State;

class ProfileFormBuilder extends CommonFormBuilder
{
    /**
     * Resume editor
     */
    public function buildProfileResumeEditor()
    {
        $dob_day_options = array();
        for ($i=1; $i < 32; $i++) {
            $dob_day_options[$i] = $i;
        }

        $dob_month_options = array();
        for ($i=1; $i < 13; $i++) {
            $month = $this->getMonth($i);
            $dob_month_options[$i] = $month;
        }

        $dob_year_options = array();
        for ($i=1947; $i < 2000; $i++) {
            $dob_year_options[$i] = $i;
        }

        $middleElem = ceil(count($dob_year_options)/2);
        $keys = array_keys($dob_year_options);
        $middleKey = $keys[$middleElem];
        $setyear = $dob_year_options[$middleKey];

        if (isset(Auth::user()->userdetail->dob_year) && Auth::user()->userdetail->dob_year != 0) {
            $setyear = Auth::user()->userdetail->dob_year;
        }

        $totalexp = 0;
        if (isset(Auth::user()->experience)) {
            foreach (Auth::user()->experience as $exp) {
                $totalexp = $totalexp + $exp->total_experience;
            }
        }

        $locations = State::all();
        $selectlocations = array();
        foreach ($locations as $l) {
            $selectlocations[$l->id] = $l->state;
        }

        $selectindustry = array();
        $industries = Industry::orderBy('industry')->get();
        foreach ($industries as $i) {
            $selectindustry[$i->id] = $i->industry;
        }

        $selectfunctional = array();
        $functionalareas = FunctionalArea::orderBy('functional_area')->get();
        foreach ($functionalareas as $f) {
            $selectfunctional[$f->id] = $f->functional_area;
        }

        $selectgender = array();
        $selectgender['Male'] = 'Male';
        $selectgender['Female'] = 'Female';
        $selectgender['Other'] = 'Other';

        $selectmaritalstatus = array();
        $selectmaritalstatus['Married'] = 'Married';
        $selectmaritalstatus['Single / Unmarried'] = 'Single / Unmarried';
        $selectmaritalstatus['In a Relationship'] = 'In a Relationship';

        $userdetail = $this->escapeUserDetail(Auth::user()->userdetail);
        return view('forms.resumeeditor')->with('userdetail', $userdetail)
                                        ->with('selectmaritalstatus', $selectmaritalstatus)
                                        ->with('selectgender', $selectgender)
                                        ->with('selectfunctional', $selectfunctional)
                                        ->with('selectindustry', $selectindustry)
                                        ->with('selectlocations', $selectlocations)
                                        ->with('totalexp', $totalexp)
                                        ->with('setyear', $setyear)
                                        ->with('dob_year_options', $dob_year_options)
                                        ->with('dob_month_options', $dob_month_options)
                                        ->with('dob_day_options', $dob_day_options)
                                        ->render();
    }

    /**
     * Education details
     */
    public function buildProfileEducationDetails()
    {
        $userdetail = $this->escapeUserDetail(Auth::user()->userdetail);
        return view('forms.educationdetails')->with('userdetail', $userdetail)->render();
    }

    /**
     * Password change
     */
    public function buildChangePasswordForm()
    {
        return view('forms.changepassword')->render();
    }

    /**
     * Employer form
     */
    public function buildEmployerProfile()
    {
        return view('forms.employerprofile')->render();
    }
}
