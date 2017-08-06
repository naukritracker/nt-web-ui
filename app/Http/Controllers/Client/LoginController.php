<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\EmployerUser;
use Hash;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Mail;
use App\User;
use App\Models\UserDetail;
use App\Role;
use Illuminate\Http\Request;
use Validator;
use Socialite;

class LoginController extends Controller
{
    /**
     * Show login page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showLogin(Request $request)
    {
        return view('login.client');
    }

    /**
     * Show homepage.
     *
     * @return Response
     */
    public function showHomeWithError($e = ['Error encountered!'])
    {
        $data['banners'] = Banner::where('active_flag', 1)->get();
        return view('client.home')->with('data', $data)->withErrors($e);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            return redirect()->action(
                'LoginController@showHomeWithError',
                [['Google service is not operational at the moment']]
            );
        }
    }

    /**
     * Redirect the user to the LinkedIn authentication page.
     *
     * @return Response
     */
    public function redirectToLinkedIn()
    {
        try {
            return Socialite::driver('linkedin')->redirect();
        } catch (Exception $e) {
            return redirect()->action(
                'LoginController@showHomeWithError',
                [['LinkedIn service is not operational at the moment']]
            );
        }
    }


    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $name = $user->getName();
            $email = $user->getEmail();
            $existingUser = null;

            if ($email) {
                $existingUser = User::where('email', $email)->where('login_type', 'google')->first();
                $registeredUser = User::where('email', $email)->where('login_type', 'registered')->first();
                if ($existingUser) {
                    Auth::login($existingUser);
                    return redirect()->route('Profile')->with('success', ['Welcome back '.$existingUser->name.'!']);
                } elseif ($registeredUser) {
                    if ($registeredUser->active_flag == 1) {
                        Auth::login($registeredUser);
                        return redirect()->route('Profile')->with(
                            'success',
                            ['Welcome back '.$registeredUser->name.'!']
                        );
                    } else {
                        return redirect()->route('ShowLogin')
                                        ->withErrors(
                                            [
                                                '"'.$registeredUser->email
                                                .'" has been registered but not activated !',
                                                'Please use the link sent to "'.$registeredUser->email
                                                .'" to activate your account.'
                                            ]
                                        );
                    }
                } else {
                    $user = new User;
                    $user->name = $name;
                    $user->login_type = 'google';
                    $user->email = $email;
                    $user->active_flag = 1;

                    $user->save();

                    $userdetails = new UserDetail;
                    $userdetails->user_id = $user->id;
                    $nameArr = explode(" ", $name);
                    $userdetails->first_name = array_shift($nameArr);
                    $userdetails->last_name = implode(" ", $nameArr);
                    $userdetails->save();

                    $candidate = Role::where('name', 'candidate')->first();
                    $user->attachRole($candidate);

                    Mail::send('emails.confirmsocialregistration', [], function ($m) use ($user) {
                        $m->from(
                                    env('DEFAULT_MAIL_ID', 'no-reply@naukritracker.com'),
                                    env('APP_NAME', 'Naukri Tracker')
                                );

                        $m->to($user->email, $user->name)
                                    ->subject('Welcome to naukritracker '.$user->name.'!');
                    });

                    Auth::login($user);
                    return redirect()->route('Profile')
                                        ->with('success', ['Welcome '.$user->name.'!']);
                }
            } else {
                throw new Exception();
            }

                // $user->token;
        } catch (Exception $e) {
            return redirect()->action(
                'LoginController@showHomeWithError',
                [['Google service is not operational at the moment']]
            );
        }
    }


    /**
     * Obtain the user information from LinkedIn.
     *
     * @return Response
     */
    public function handleLinkedInCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
            $name = $user->getName();
            $email = $user->getEmail();
            $existingUser = null;

            if ($email) {
                $existingUser = User::where('email', $email)->where('login_type', 'linkedin')->first();
                $registeredUser = User::where('email', $email)->where('login_type', 'registered')->first();
                if ($existingUser) {
                    Auth::login($existingUser);
                    return redirect()->route('Profile')->with('success', ['Welcome back !']);
                } elseif ($registeredUser) {
                    if ($registeredUser->active_flag == 1) {
                        Auth::login($registeredUser);
                        return redirect()->route('Profile')
                                        ->with('success', ['Welcome back '.$registeredUser->name.'!']);
                    } else {
                        return redirect()->route('ShowLogin')->withErrors(
                            [
                                '"'.$registeredUser->email.'" has been registered but not activated !',
                                'Please use the link sent to "'.$registeredUser->email.'" to activate your account.'
                            ]
                        );
                    }
                } else {
                    $user = new User;
                    $user->name = $name;
                    $user->login_type = 'linkedin';
                    $user->email = $email;
                    $user->active_flag = 1;

                    $user->save();

                    $userdetails = new UserDetail;
                    $userdetails->user_id = $user->id;
                    $nameArr = explode(" ", $name);
                    $userdetails->first_name = array_shift($nameArr);
                    $userdetails->last_name = implode(" ", $nameArr);
                    $userdetails->save();

                    $candidate = Role::where('name', 'candidate')->first();
                    $user->attachRole($candidate);

                    Mail::send('emails.confirmsocialregistration', [], function ($m) use ($user) {
                        $m->from(
                            env('DEFAULT_MAIL_ID', 'no-reply@naukritracker.com'),
                            env('APP_NAME', 'Naukri Tracker')
                        );

                        $m->to($user->email, $user->name)->subject('Welcome to naukritracker !');
                    });

                    Auth::login($user);
                    return redirect()->route('Profile')->with('success', ['Welcome '.$name.'!']);
                }
            } else {
                throw new Exception();
            }

            // $user->token;
        } catch (Exception $e) {
            return redirect()->action(
                'LoginController@showHomeWithError',
                [['Google service is not operational at the moment']]
            );
        }
    }



    /**
     * Log user in to the application.
     *
     * @param  Request  $request
     * @return Response
     */
    public function doLogin(Request $request)
    {
        if ($request->ajax()) {
            $validationRules = [
                'email' => 'required|email',
                'password' => 'required'
            ];

            $validation = Validator::make($request->all(), $validationRules);
            if ($validation->fails()) {
                $data['success'] = false;
                $data['errors'] = $validation->errors();
                return response()->json($data);
            }
        } else {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);
        }

        $email = $request->get('email');
        $password = $request->get('password');
        $type = $request->get('type');
        if ($type == "user" and !User::where('email', $email)->first()) {
            return response()->json(['success' => false, 'errors' => ['We could not find this user. Are you sure you\'ve registered with us?']]);
        } else if ($type == "employer"  and !EmployerUser::where('email', $email)->first()) {
            return response()->json(['success' => false, 'errors' => ['We could not find this employer. Are you sure you\'ve registered with us?']]);
        }
        if (Auth::attempt($type, ['email' => $email, 'password' => $password, 'active_flag' => 1], $request->get('remember'))) {
            if ($request->ajax()) {
                $response = response()->json(['success'=>false,'errors'=>route('Home')]);
                $request->session()->flash('success', ['Login completed successfully']);
                if (Auth::user()) {
                    $response = response()->json(['success'=>true,'redirect'=>route('Profile')]);
                } else if (Auth::user("employer")) {
                    $response = response()->json(['success'=>true,'redirect'=>route('EmployerProfile')]);
                }
                return $response;
            } else {
                $view = redirect()->route('Home');
                if (Auth::user()) {
                    $view = redirect()->route('Profile')->with('success', ['Welcome ' . Auth::user()->name]);
                } else if (Auth::user("employer")) {
                    $view = redirect()->route('EmployerProfile')->with('success', ['Welcome '.Auth::user("employer")->name]);
                }
                return $view;
            }
        } else {
            if ($request->ajax()) {
                return response()->json(['success'=>false,'errors'=>'Username/Password Invalid']);
            } else {
                return back()->withErrors(['Username/Password Invalid']);
            }
        }
    }
    /**
     * Log user out of application.
     *
     * @param  Request  $request
     * @return Response
     */
    public function doLogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        Cookie::queue(Cookie::forget('laravel_session'));
        return redirect()->route('Home');
    }
    /**
     * Show forgot password page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showForgotPassword(Request $request)
    {
        return view('login.forgot');
    }
    /**
     * Reset forgotten password.
     *
     * @param  Request  $request
     * @return Response
     */
    public function resetForgotPassword(Request $request)
    {
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if (!isset($user)) {
            $user = Employer::where('email', $email)->first();
            if(!isset($user)) {
                return back()->withErrors(['No user found. Please try again']);
            }
        }
        $newpassword = self::generateStrongPassword();
        $user->password = Hash::make($newpassword);
        if ($user->save()) {
            Mail::send(
                'emails.forgotpassword',
                ['username' => $user->name, 'useremail' => $user->email,'password' => $newpassword],
                function ($m) use ($email) {
                    $m->from(
                        env('DEFAULT_MAIL_ID', 'no-reply@naukritracker.com'),
                        env('APP_NAME', 'Naukri Tracker')
                    );

                    $m->to($email)->subject('Naukri Tracker - Password reset requested');
                }
            );

            $customsuccess = array('Password has been reset. Please check your mail and use new password to login');
            return redirect()->route('ShowLogin')->with('success', $customsuccess);
        } else {
            $customerrors = array('Unable to reset password for the user provided');
            return back()->withErrors($customerrors);
        }
    }
    /**
     * Generate a strong password
     *
     * @param int $length
     * @param bool $add_dashes
     * @param string $available_sets
     *
     * @return string
     */
    public function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if (strpos($available_sets, 'l') !== false) {
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        }
        if (strpos($available_sets, 'u') !== false) {
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        }
        if (strpos($available_sets, 'd') !== false) {
            $sets[] = '23456789';
        }
        if (strpos($available_sets, 's') !== false) {
            $sets[] = '!@#$%&*?';
        }
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++) {
            $password .= $all[array_rand($all)];
        }
        $password = str_shuffle($password);
        if (!$add_dashes) {
            return $password;
        }
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}
