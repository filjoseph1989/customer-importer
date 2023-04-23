<?php

namespace App\Providers;

use Illuminate\Validation\ValidationServiceProvider as BaseValidationServiceProvider;

class ValidationServiceProvider extends BaseValidationServiceProvider
{
    public function register()
    {
        parent::register();
    }
}