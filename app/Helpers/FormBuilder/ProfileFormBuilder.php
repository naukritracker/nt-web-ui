<?php

namespace App\Helpers\FormBuilder;

use App\Models\Country;
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
        for ($i=1947; $i < 2017; $i++) {
            $dob_year_options[$i] = $i;
        }

        $middleElem = ceil(count($dob_year_options)/2);
        $keys = array_keys($dob_year_options);
        $middleKey = $keys[$middleElem];
      // $setyear = $dob_year_options[$middleKey];

        if (isset(Auth::user()->userdetail->dob_year) && Auth::user()->userdetail->dob_year != 0) {
            $setyear = Auth::user()->userdetail->dob_year;
        }

        $totalexp = 0;
        if (isset(Auth::user()->experience)) {
            foreach (Auth::user()->experience as $exp) {
                $totalexp = $totalexp + $exp->total_experience;
            }
        }

        $locations = Country::all();
        $selectlocations = array();
        foreach ($locations as $l) {
            $selectlocations[$l->id] = $l->country;
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

		
		
		
		$selectexp = array();
        $selectexp['Fresher'] = 'Fresher';
        $selectexp['tab'] = 'Experienced';
        

        $userdetail = $this->escapeUserDetail(Auth::user()->userdetail);
        return view('forms.resumeeditor')->with('userdetail', $userdetail)
                                        ->with('selectmaritalstatus', $selectmaritalstatus)
                                        ->with('selectgender', $selectgender)
                                        ->with('selectfunctional', $selectfunctional)
                                        ->with('selectindustry', $selectindustry)
                                        ->with('selectlocations', $selectlocations)
                                        ->with('totalexp', $totalexp)
                                      //->with('setyear', $setyear)
                                        ->with('dob_year_options', $dob_year_options)
                                        ->with('dob_month_options', $dob_month_options)
                                        ->with('dob_day_options', $dob_day_options)
										->with('selectexp', $selectexp)
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
	
	public function buildProfileEmpDetails()
    {
		
       

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

       
		
		
 $annual_lakh_options = array();
  $annual_lakh_options[0]='Lakhs';
        for ($i=1; $i<=99; $i++) {
            array_push($annual_lakh_options, $i);
        }

        $annual_thousand_options = array();
		$annual_thousand_options[0]='Thousands';
        for ($i=0; $i<100; $i++) {
            array_push($annual_thousand_options, $i);
        }

		

        $userdetail = $this->escapeUserDetail(Auth::user()->userdetail);
        return view('forms.empDetails')->with('userdetail', $userdetail)                                   
                                        ->with('selectfunctional', $selectfunctional)
                                        ->with('selectindustry', $selectindustry)                                     
										->with('annual_lakh_options', $annual_lakh_options)
										->with('annual_thousand_options', $annual_thousand_options)									
                                        ->render();
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
