<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\InvokableRule;

class RecaptchaValidation implements InvokableRule
{
    /**
     * Determine if the given reCAPTCHA token represents a successful or unsuccessful validation attempt.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function __invoke($attribute, $value, $fail)
    {
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => env('RECAPTCHA_PRIVATE_KEY', false),
                    'remoteip' => request()->getClientIp(),
                    'response' => $value
                ]
            ]
        );
        $body = json_decode($response->getBody());

        if (!$body->success) {
            $fail('reCAPTCHA verification failed.');
        } else {
            return ($body->success);
        }
    }
}