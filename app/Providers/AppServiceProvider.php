<?php

namespace App\Providers;

use App\Imports\CustomerImporter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('importer', CustomerImporter::class);
    }
}
