<?php

namespace App\Helpers\FormBuilder;

use App\Models\Company;
use App\Models\Country;

class RegisterFormBuilder extends CommonFormBuilder
{
    /**
     * Register user
     */
    public function buildRegisterClientForm()
    {
        $companies = Company::all();
        $selectcompanies = array();
        foreach ($companies as $c) {
            $selectcompanies[$c->id] = $c->name;
        }
        $selectcompanies['0'] = 'Fresher';
        $selectcompanies['ot'] = 'Other';

        $countries = Country::all();
        $selectcountries = array();
        foreach ($countries as $country) {
            $selectcountries[$country->id] = $country->country;
        }

        return view('forms.registerclient')->with('selectcompanies', $selectcompanies)
                                        ->with('selectcountries', $selectcountries)
                                        ->render();
    }

    /**
     * Register employer
     */
    public function buildRegisterEmployerForm()
    {
        $companies = Company::all();
        $selectCompany = array();
        $selectCompany['new'] = 'Add Company';
        foreach ($companies as $c) {
            $selectCompany[$c->id] = $c->name;
        }
        return view('forms.registeremployer')->with('selectCompany', $selectCompany)->render();
    }
}
