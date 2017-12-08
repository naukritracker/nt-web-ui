<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\JobPosting;
use App\Models\Banner;
use App\Models\StaticPage;
use ReCaptcha\ReCaptcha;
use Validator;
use Mail;
use Illuminate\Http\Request;
use App\Helpers\Contracts\FormBuilderContract as FormBuilder;

class HomeController extends Controller
{
    /**
     * Show homepage.
     *
     * @return Response
     */
    public function showHome()
    {
        return view('client.home');
    }


    /**
     * Show static pages.
     *
     * @return Response
     */
    public function showStaticPage($name)
    {
        $data['page'] = StaticPage::where('slug', $name)->first();
        return view('client.staticpage')->with('data', $data);
    }


    /**
     * Show home banner search.
     *
     * @param  Request  $request
     * @return string|int
     */
    public function loadHomeSearch(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
            $html = '';
            $html = $formbuilder->build('SearchForJobs');
            return $html;
        } else {
            return -1;
        }
    }



    /**
     * Show terms and conditions.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showTermsAndConditions(Request $request)
    {
        if ($request->ajax()) {
            return false;
        } else {
            return view('client.termsandconditions');
        }
    }
	
	
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
	
	
	
	 
}
