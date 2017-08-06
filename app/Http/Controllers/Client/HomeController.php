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
}
