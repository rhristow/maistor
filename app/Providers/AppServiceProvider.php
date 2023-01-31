<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register() {
    }

    public function boot() {
        // Send all non-production e-mails to rhristow@gmail.com //
        if(!app()->environment('production')) {
            Mail::alwaysTo('rhristow@gmail.com');
        }

        // Custom Validators //
        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            return preg_match('%^(?:[+]\d{1,3}?\d{6,14})$%i', str_replace(' ', '', $value));
        });
    }
}
