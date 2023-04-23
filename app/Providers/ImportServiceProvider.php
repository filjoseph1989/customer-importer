<?php

namespace App\Providers;

use App\Imports\ProductImporter;
use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('importer', ProductImporter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
