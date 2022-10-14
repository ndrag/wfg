<?php

namespace App\Http\Controllers\Actions;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        dd($request);
        // dd($request->validated());
        // return redirect()->route( route: 'homepage');
    }
}
