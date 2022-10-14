<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactPostRequest;
use App\Mail\ContactFormSubmission;

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
            ->queue(new ContactFormSubmission($request->all()));
        
        return redirect()->route( route: 'homepage');
    }
}
