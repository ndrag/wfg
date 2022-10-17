<?php

namespace App\Http\Controllers\Actions;

use App\Mail\ContactFormSubmission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ContactPostRequest;

class SaveContactForm extends Controller
{

    /**
     * __invoke
     *
     * @param  App\Http\Requests\ContactPostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ContactPostRequest $request)
    {
        
        Mail::to(env('MAIL_TO_ADDRESS'), 'Admin')
            ->send(new ContactFormSubmission($request->all()));

        return Redirect::back();
    }
}
