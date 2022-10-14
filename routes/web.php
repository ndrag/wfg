<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get(
    '/',
    function () {
        return Inertia::render(
            env('APP_ENV', 'local') == 'local' ? 'Home' : 'Placeholder',
            [
                'title' => 'Works for Good',
            ]
        );
    }
)->name( 'homepage' );

Route::get(
    '/development-view',
    function () {
        return Inertia::render(
            'Home',
            [
                'title' => 'Works for Good',
            ]
        );
    }
)->name( 'dev' );