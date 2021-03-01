<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class CaptchaValidationController extends Controller
{
    /**
     *
     */
    public function index()
    {

    }

    public function validateGCaptcha(Request $request)
    {
        //dd($request->all());
        $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'login');

        dump($request->get('g-recaptcha-response'));
        dd($score);

        $request->validate([
            'g-recaptcha-response' => 'required|recaptchav3:login,0.5'
        ]);

    }
}
