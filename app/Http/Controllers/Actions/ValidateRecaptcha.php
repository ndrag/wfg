<?php

namespace App\Http\Controllers\Actions;

use Illuminate\Http\Request;
use App\Rules\RecaptchaValidation;
use App\Http\Controllers\Controller;

class ValidateRecaptcha extends Controller
{

    /**
     * __invoke
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'recaptcha_validation_token' =>
            ['required', new RecaptchaValidation()]
        ]);

        return true;
    }
}
