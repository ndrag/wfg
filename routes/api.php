<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Actions\SaveContactForm;
use App\Http\Controllers\Actions\ValidateRecaptcha;

Route::post('/save-contact-form', SaveContactForm::class)->name('save-contact-form');
Route::post('/validate-recaptcha-response', ValidateRecaptcha::class)->name('validate-recaptcha-response');