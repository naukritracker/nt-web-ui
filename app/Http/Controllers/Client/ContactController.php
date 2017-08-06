<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use ReCaptcha\ReCaptcha;
use Validator;

class ContactController extends Controller
{
    /**
     * Do contact us form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doContact(Request $request)
    {
        $niceNames = array(
            'cmail' => 'mail',
            'cmessage' => 'message',
            'g-recaptcha-response'  => 'captcha'
        );
        $validator = Validator::make($request->all(), [
            'cmail' => 'required|email',
            'cmessage' => 'required',
            'g-recaptcha-response'  => 'required'
        ]);

        $validator->setAttributeNames($niceNames);

        $secret = env('GOOGLE_CAPTCHA_SECRET', '');
        $captcha = $request->has('g-recaptcha-response') ? $request->get('g-recaptcha-response') : '';
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($captcha, $remoteip);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($resp->isSuccess()) {
                Mail::send(
                    'emails.contactus',
                    [
                        'cmail' => $request->get('cmail'),
                        'cmessage' => $request->get('cmessage')
                    ],
                    function ($m) {
                        $m->from(
                            env('DEFAULT_MAIL_ID', 'no-reply@naukritracker.com'),
                            env('APP_NAME', 'Naukri Tracker')
                        );
                        $m->to(env('ADMIN_EMAIL_ID', 'hr.kasheef@gmail.com'), 'Naukri Tracker Admin')
                            ->subject('Query posted on Naukri Tracker on '.date('M, Y').' at '.date('H:i'));
                    }
                );
                return back()->with(
                    'success',
                    [
                        'Your message has been forwarded to our concerned representatives. '
                        .'Thank you for your interest !'
                    ]
                );
            } else {
                return back()->withErrors(['Captcha verification failed !'])->withInput();
            }
        }
    }
}
