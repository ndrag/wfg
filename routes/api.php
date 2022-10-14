<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Actions\SaveContactForm;

Route::post('/save-contact-form', SaveContactForm::class)->name('save-contact-form');