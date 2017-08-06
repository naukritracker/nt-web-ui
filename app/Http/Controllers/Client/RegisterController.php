<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\EmployerUser;
use App\Models\EmployerUserDetails;
use Auth;
use Hash;
use Validator;
use App\User;
use App\Models\UserDetail;
use App\Role;
use App\Models\Experience;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Helpers\Contracts\FormBuilderContract as FormBuilder;

class RegisterController extends Controller
{
    /**
     * Show registration page.
     *
     * @return Response
     */
    public function showRegister()
    {
        $allcountries = Country::all();
        $countries = array();
        foreach ($allcountries as $country) {
            $countries[$country->id] = $country->country;
        }
        return view('register.client')->with('countries', $countries);
    }


    /**
     * Load registration form.
     *
     * @return Response
     */
    public function loadRegisterForm(FormBuilder $formbuilder)
    {
        $form = $formbuilder->build('RegisterClient');
        return $form;
    }

    /**
     * Load state list.
     *
     * @return Response
     */
    public function loadStateList($country = null)
    {
        $html = "";
        if ($country != null) {
            $states = State::where('country_id', $country)->get();
        } else {
            $states = State::all();
        }
        $html .= '<option value="" selected>Select State</option>';
        foreach ($states as $s) {
            $html .= '<option value="'.$s->id.'">'.$s->state.'</option>';
        }

        return $html;
    }

    /**
     * Load company list.
     *
     * @return Response
     */
    public function loadCompanyList($selectcompany = null)
    {
        $html = "";
        $companies = Company::all();
        if ($selectcompany) {
            $html .= '<option value="">Select employer</option>';
        } else {
            $html .= '<option value="" selected>Select employer</option>';
        }
        
        foreach ($companies as $c) {
            if ($selectcompany == $c->id) {
                $html .= '<option value="'.$c->id.'" selected>'.$c->name.'</option>';
            } else {
                $html .= '<option value="'.$c->id.'">'.$c->name.'</option>';
            }
        }

        $html .= '<option value="0">Fresher</option>';
        $html .= '<option value="ot">Other</option>';

        return $html;
    }

    /**
     * Store client registration details.
     * @param Request $request
     * @return Response
     */
    public function doRegister(Request $request)
    {
        if ($request->ajax()) {
            $validationRules = [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'contact_no' => 'required',//ERROR : JQUERY PASSES WHEN MAX VAL IS 10 BUT THIS VALIDATION DOESNT
                'first_name' => 'required',
                'last_name' => 'required',
                'company' => 'required',
                'agreetoconditions' => 'required',
                'resume' => 'mimes:pdf,doc,docx,rtf|max:300'
            ];

            $validation = Validator::make($request->all(), $validationRules);

            if ($validation->fails()) {
                $data['success'] = false;
                $data['errors'] = $validation->errors();

                return response()->json($data);
            }
        } else {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'contact_no' => 'required',//ERROR : JQUERY PASSES WHEN MAX VAL IS 10 BUT THIS VALIDATION DOESNT
                'first_name' => 'required',
                'last_name' => 'required',
                'company' => 'required',
                'agreetoconditions' => 'required',
                'resume' => 'mimes:pdf,doc,docx,rtf|max:300'
                ]);
        }

        $newuser = new User;
        $newuser->email = $request->get('email');
        $newuser->password = Hash::make($request->get('password'));
        $newuser->name = $request->get('first_name').' '.$request->get('last_name');
        $newuser->login_type = 'registered';
        
        $digits = 8;
        $confirmation_code = rand(pow(10, $digits-1), pow(10, $digits)-1);

        $newuser->active_flag = $confirmation_code;
        $newuser->save();

        $userdetails = new UserDetail;
        $userdetails->user_id = $newuser->id;
        $userdetails->state_id = $request->get('state');
        $userdetails->first_name = $request->get('first_name');
        $userdetails->last_name = $request->get('last_name');
        $userdetails->contact_no = $request->get('contact_no');
        $userdetails->profile_headline = '';
        $userdetails->current_location = 0;
        $userdetails->preferred_location = 0;
        $userdetails->dob_day = 0;
        $userdetails->dob_month = 0;
        $userdetails->dob_year = 0;
        $userdetails->country_code = $request->get('country_code');
        $userdetails->city = $request->get('city');

        if ($request->get('education_type') == 10) {
            $userdetails->sse_institution = $request->get('educational_institute_name');
            $userdetails->sse_start_date = date("Y-m-d H:i:s", strtotime($request->get('education_start_date')));
            $userdetails->sse_end_date = date("Y-m-d H:i:s", strtotime($request->get('education_end_date')));
            
            $userdetails->hsse_institution = '';
            $userdetails->ug_institution = '';
            $userdetails->pg_institution = '';
            $userdetails->other_institution = '';
            $userdetails->hsse_start_date = '0000-00-00 00:00:00';
            $userdetails->ug_start_date = '0000-00-00 00:00:00';
            $userdetails->pg_start_date = '0000-00-00 00:00:00';
            $userdetails->other_start_date = '0000-00-00 00:00:00';
            $userdetails->hsse_end_date = '0000-00-00 00:00:00';
            $userdetails->ug_end_date = '0000-00-00 00:00:00';
            $userdetails->pg_end_date = '0000-00-00 00:00:00';
            $userdetails->other_end_date = '0000-00-00 00:00:00';
            $userdetails->sse_marks = 0;
            $userdetails->hsse_marks = 0;
            $userdetails->ug_marks = 0;
            $userdetails->pg_marks = 0;
            $userdetails->other_marks = 0;
        } elseif ($request->get('education_type') == 12) {
            $userdetails->hsse_institution = $request->get('educational_institute_name');
            $userdetails->hsse_start_date = date("Y-m-d H:i:s", strtotime($request->get('education_start_date')));
            $userdetails->hsse_end_date = date("Y-m-d H:i:s", strtotime($request->get('education_end_date')));


            $userdetails->sse_institution = '';
            $userdetails->ug_institution = '';
            $userdetails->pg_institution = '';
            $userdetails->other_institution = '';
            $userdetails->sse_start_date = '0000-00-00 00:00:00';
            $userdetails->ug_start_date = '0000-00-00 00:00:00';
            $userdetails->pg_start_date = '0000-00-00 00:00:00';
            $userdetails->other_start_date = '0000-00-00 00:00:00';
            $userdetails->sse_end_date = '0000-00-00 00:00:00';
            $userdetails->ug_end_date = '0000-00-00 00:00:00';
            $userdetails->pg_end_date = '0000-00-00 00:00:00';
            $userdetails->other_end_date = '0000-00-00 00:00:00';
            $userdetails->sse_marks = 0;
            $userdetails->hsse_marks = 0;
            $userdetails->ug_marks = 0;
            $userdetails->pg_marks = 0;
            $userdetails->other_marks = 0;
        } elseif ($request->get('education_type') == 0) {
            $userdetails->ug_institution = $request->get('educational_institute_name');
            $userdetails->ug_start_date = date("Y-m-d H:i:s", strtotime($request->get('education_start_date')));
            $userdetails->ug_end_date = date("Y-m-d H:i:s", strtotime($request->get('education_end_date')));


            $userdetails->hsse_institution = '';
            $userdetails->sse_institution = '';
            $userdetails->pg_institution = '';
            $userdetails->other_institution = '';
            $userdetails->hsse_start_date = '0000-00-00 00:00:00';
            $userdetails->sse_start_date = '0000-00-00 00:00:00';
            $userdetails->pg_start_date = '0000-00-00 00:00:00';
            $userdetails->other_start_date = '0000-00-00 00:00:00';
            $userdetails->hsse_end_date = '0000-00-00 00:00:00';
            $userdetails->sse_end_date = '0000-00-00 00:00:00';
            $userdetails->pg_end_date = '0000-00-00 00:00:00';
            $userdetails->other_end_date = '0000-00-00 00:00:00';
            $userdetails->hsse_marks = 0;
            $userdetails->sse_marks = 0;
            $userdetails->ug_marks = 0;
            $userdetails->pg_marks = 0;
            $userdetails->other_marks = 0;
        } elseif ($request->get('education_type') == 1) {
            $userdetails->pg_institution = $request->get('educational_institute_name');
            $userdetails->pg_start_date = date("Y-m-d H:i:s", strtotime($request->get('education_start_date')));
            $userdetails->pg_end_date = date("Y-m-d H:i:s", strtotime($request->get('education_end_date')));


            $userdetails->hsse_institution = '';
            $userdetails->ug_institution = '';
            $userdetails->sse_institution = '';
            $userdetails->other_institution = '';
            $userdetails->hsse_start_date = '0000-00-00 00:00:00';
            $userdetails->ug_start_date = '0000-00-00 00:00:00';
            $userdetails->sse_start_date = '0000-00-00 00:00:00';
            $userdetails->other_start_date = '0000-00-00 00:00:00';
            $userdetails->hsse_end_date = '0000-00-00 00:00:00';
            $userdetails->ug_end_date = '0000-00-00 00:00:00';
            $userdetails->sse_end_date = '0000-00-00 00:00:00';
            $userdetails->other_end_date = '0000-00-00 00:00:00';
            $userdetails->hsse_marks = 0;
            $userdetails->ug_marks = 0;
            $userdetails->pg_marks = 0;
            $userdetails->sse_marks = 0;
            $userdetails->other_marks = 0;
        } elseif ($request->get('education_type') == 2) {
            $userdetails->hsse_institution = $request->get('educational_institute_name');
            $userdetails->other_start_date = date("Y-m-d H:i:s", strtotime($request->get('education_start_date')));
            $userdetails->other_end_date = date("Y-m-d H:i:s", strtotime($request->get('education_end_date')));


            $userdetails->hsse_institution = '';
            $userdetails->ug_institution = '';
            $userdetails->pg_institution = '';
            $userdetails->sse_institution = '';
            $userdetails->hsse_start_date = '0000-00-00 00:00:00';
            $userdetails->ug_start_date = '0000-00-00 00:00:00';
            $userdetails->pg_start_date = '0000-00-00 00:00:00';
            $userdetails->sse_start_date = '0000-00-00 00:00:00';
            $userdetails->hsse_end_date = '0000-00-00 00:00:00';
            $userdetails->ug_end_date = '0000-00-00 00:00:00';
            $userdetails->pg_end_date = '0000-00-00 00:00:00';
            $userdetails->sse_end_date = '0000-00-00 00:00:00';
            $userdetails->hsse_marks = 0;
            $userdetails->ug_marks = 0;
            $userdetails->pg_marks = 0;
            $userdetails->sse_marks = 0;
            $userdetails->other_marks = 0;
        }


        if ($request->hasFile('resume')) {
            $media = new Media;
            $medianame = strtolower($request->get('first_name').''.$request->get('last_name'))
                        .'_'
                        .$newuser->id.'_resume.'
                        .$request->file('resume')->getClientOriginalExtension();
            try {
                $request->file('resume')->move(public_path().'/uploads/resume', $medianame);
                $media->content = $medianame;
                $pdf = new \App\Http\Controllers\Utility\PdfController(public_path().'/uploads/resume/'.$medianame);
                $media->raw = $pdf->decode();
                if ($media->save()) {
                    $userdetails->resume_media_id = $media->id;
                } else {
                    $userdetails->resume_media_id = 0;
                }
            } catch (\Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            $userdetails->resume_media_id = 0;
        }


        $userdetails->save();

        if ($request->get('company') != 0) {
            $d1 = 0;
            $d2 = 0;
            $userexperience = new Experience;
            $userexperience->company_id = $request->get('company');
            $userexperience->state_id = $request->get('state');
            $userexperience->user_id = $newuser->id;
            if ($request->has('experience_start_date')) {
                $userexperience->start_date = date("Y-m-d H:i:s", strtotime($request->get('experience_start_date')));
            }
            if ($request->has('experience_end_date')) {
                $userexperience->end_date = date("Y-m-d H:i:s", strtotime($request->get('experience_end_date')));
            }
            $userexperience->save();
        }

        

        $candidate = Role::where('name', 'candidate')->first();
        $newuser->attachRole($candidate);
        $newuser->save();

//        Mail::send(
//            'emails.confirmregistration',
//            ['link' => route('ConfirmRegistration', ['email'=>$newuser->email,'code'=>$confirmation_code])],
//            function ($m) use ($newuser) {
//                $m->from(
//                    env('DEFAULT_MAIL_ID', 'no-reply@naukritracker.com'),
//                    env('APP_NAME', 'Naukri Tracker')
//                );
//                $m->to($newuser->email, $newuser->name)->subject('Welcome to naukritracker !');
//            }
//        );

        if ($request->ajax()) {
            $request->session()->flash(
                'success',
                [
                    'An email has been sent to the email ID provided. '
                    .'Please use the link provided to confirm your email.'
                ]
            );
            return response()->json(['success'=>true,'redirect'=>route('ShowLogin')]);
        } else {
            return redirect()->route('ShowLogin')->with(
                'success',
                [
                    'An email has been sent to the email ID provided. '
                    .'Please use the link provided to confirm your email.'
                ]
            );
        }
    }

    public function doRegisterCompany(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|unique:company,name,NULL,id,country_id,'
                            .$request->get('country').',state_id,'
                            .$request->get('state'),
                    'country' => 'required',
                    'state' => 'required',
                ]
            );

            if ($validator->fails()) {
                $data['success'] = -1;
                $data['errors'] = $validator->errors();
                return $data;
            } else {
                $company = new Company;
                $company->name = $request->get('name');
                $company->description = $request->get('description');
                $company->city = $request->get('city');
                $company->country_id = $request->get('country');
                $company->state_id = $request->get('state');
                $company->contactno = $request->get('contactNo');
                $company->website = $request->get('website');
                $company->address = $request->get('address');
                
                if ($company->save()) {
                    $data['success'] = 1;
                    $data['company_id'] = $company->id;
                    $data['company_name'] = $company->name;
                    return $data;
                } else {
                    $data['success'] = -1;
                    return $data;
                }
            }
        } else {
            $this->validate($request, [
                'name' => 'required|unique:company,name,NULL,id,country_id,'
                .$request->get('country')
                .',state_id,'
                .$request->get('state'),
                'country' => 'required',
                'state' => 'required',
            ]);

            $company = new Company;
            $company->name = $request->get('name');
            $company->description = $request->get('description');
            $company->city = $request->get('city');
            $company->country_id = $request->get('country');
            $company->state_id = $request->get('state');
            $company->contactno = $request->get('contactNo');
            $company->website = $request->get('website');
            $company->address = $request->get('address');
            $company->save();

            return back();
        }
    }

    public function confirmRegister($email, $code)
    {
        $user = User::where('email', $email)->where('active_flag', $code)->first();
        if ($user) {
            if ($user->count() > 0) {
                $user->active_flag = 1;
                $user->save();

                return redirect()->route('ShowLogin')->with(
                    'success',
                    ['Thank you for registering with us. Please log in to continue.']
                );
            } else {
                return redirect()->route('ShowLogin')->withErrors(['Invalid access protocol']);
            }
        } else {
            return redirect()->route('ShowLogin')->withErrors(['Invalid access protocol']);
        }
    }

    public function loadEmployerRegisterForm(FormBuilder $formbuilder)
    {
        return $formbuilder->build('RegisterEmployer');
    }

    public function doEmployerRegister(Request $request)
    {
        if ($request->ajax()) {
            $validationRules = [
                'companyName' => 'required|unique:employers,name',
                'companyEmail' => 'required|email|unique:employers,email',
                'companyPhone' => 'required|max:9',
                'companyCountryCode' => 'required|max:3',
                'password' => array(
                    "required",
                    "min:8",
                    "confirmed",
                    "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}/"
                ),
                'password_confirmation' => 'required',
                'terms_and_conditions' => 'required'
            ];

            $validationMessages = [
                'regex' => 'The password must contain at least one capital, one number and a symbol'
            ];

            $validator = Validator::make($request->all(), $validationRules, $validationMessages);

            if ($validator->fails()) {
                $data['success'] = false;
                $data['errors'] = $validator->errors();
                return response()->json($data);
            }
            if (!$validator->fails()) {
                $employer = new Employer();
                $employer->name = $request->get('companyName');
                $employer->address = trim($request->get('companyAddress'));
                $employer->email = $request->get('companyEmail');
                $employer->phone = $request->get('companyPhone');

                $employerUser = new EmployerUser();
                $employerUser->name = $request->get('companyName');
                $employerUser->first_name = isset(explode(" ", $request->get('companyName'))[0]) ? explode(" ", $request->get('companyName'))[0] : $request->get('companyName');
                $employerUser->last_name = isset(explode(" ", $request->get('companyName'))[1]) ? explode(" ", $request->get('companyName'))[1] : $request->get('companyName');
                $employerUser->email = $request->get('companyEmail');
                $employerUser->password = Hash::make($request->get('password'));
                $digits = 8;
                $confirmation_code = rand(pow(10, $digits-1), pow(10, $digits)-1);
                $employerUser->active_flag = $confirmation_code;
                $employerUser->employer_id = 0;
                if ($employerUser->save()) {
                    $employer->active_flag = 0;
                    $employer->admin_id = $employerUser->id;
                    if ($employer->save()) {
                    $userDetail = new EmployerUserDetails();
                    $userDetail->employer_user_id = $employerUser->id;
                    $userDetail->first_name = isset(explode(" ", $request->get('companyName'))[0]) ? explode(" ", $request->get('companyName'))[0] : $request->get('companyName');
                    $userDetail->last_name = isset(explode(" ", $request->get('companyName'))[1]) ? explode(" ", $request->get('companyName'))[1] : $request->get('companyName');
                    $userDetail->state_id = 0;
                    $userDetail->resume_media_id = 0;
                    $userDetail->profile_headline = '';
                    $userDetail->current_location = 0;
                    $userDetail->preferred_location = 0;
                    $userDetail->dob_day = 0;
                    $userDetail->dob_month = 0;
                    $userDetail->dob_year = 0;
                    $userDetail->sse_institution = '';
                    $userDetail->hsse_institution = '';
                    $userDetail->ug_institution = '';
                    $userDetail->pg_institution = '';
                    $userDetail->other_institution = '';
                    $userDetail->sse_start_date = '0000-00-00 00:00:00';
                    $userDetail->hsse_start_date = '0000-00-00 00:00:00';
                    $userDetail->ug_start_date = '0000-00-00 00:00:00';
                    $userDetail->pg_start_date = '0000-00-00 00:00:00';
                    $userDetail->other_start_date = '0000-00-00 00:00:00';
                    $userDetail->sse_end_date = '0000-00-00 00:00:00';
                    $userDetail->hsse_end_date = '0000-00-00 00:00:00';
                    $userDetail->ug_end_date = '0000-00-00 00:00:00';
                    $userDetail->pg_end_date = '0000-00-00 00:00:00';
                    $userDetail->other_end_date = '0000-00-00 00:00:00';
                    $userDetail->sse_marks = 0;
                    $userDetail->hsse_marks = 0;
                    $userDetail->ug_marks = 0;
                    $userDetail->pg_marks = 0;
                    $userDetail->other_marks = 0;
                    $userDetail->contact_no = $request->get('companyPhone');
                    $userDetail->country_code = $request->get('companyCountryCode');
                    $userDetail->save();

                    $employerUser->employer_id = $employer->id;
                    $employerUser->save();


//                        Mail::send(
//                            'emails.confirmemployerregistration',
//                            ['link' => route('ConfirmRegistration', ['email' => $employerUser->email, 'code' => $confirmation_code])],
//                            function ($m) use ($employerUser, $employer) {
//                                $m->from(
//                                    env('DEFAULT_MAIL_ID', 'no-reply@naukritracker.com'),
//                                    env('APP_NAME', 'Naukri Tracker')
//                                );
//                                $m->to($employerUser->email, $employer->name)->subject('Welcome to naukritracker !');
//                            }
//                        );
                    // TODO : CHECK if setup properly
//                    Auth::login("employer", $employerUser);
                    $data['success'] = true;
                    $data['message'] = 'Please confirm your mail id when you get the chance ! Happy Hunting !';
                    $request->session()->flash('success', ['Please confirm your mail id when you get the chance ! Happy Hunting !']);
                    $data['redirect'] = route('ShowLogin');
                    }
                } else {
                    $data['success'] = false;
                    $data['errors'] = ['Form' => 'Failed to create employer'];
                }
                return response()->json($data);

            }
        }
    }

    public function loadCountryData()
    {
        $companies = Company::all();
        $html = '<option value="new">Add Company</option>';
        foreach ($companies as $c) {
            $html .= '<option value="'.$c->id.'">'.$c->name.'</option>';
        }
        return $html;
    }
}
