<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get(
    '/',
    function () {
        return Inertia::render(
            'Placeholder',
            [
                'title' => 'Works for Good',
            ]
        );
    }
)->name( 'homepage' );