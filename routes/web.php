<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get(
    '/',
    function () {
        return Inertia::render(
            'Home',
            [
                'title' => 'Works for Good',
            ]
        );
    }
)->name( 'homepage' );

Route::get(
    'env',
    function () {
        return Inertia::render(
            'Env',
            [
                'env_vars' => $_ENV,
            ]
        );
    }
)->name( 'homepage' );