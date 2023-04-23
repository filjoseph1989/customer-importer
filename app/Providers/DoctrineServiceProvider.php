<?php

namespace App\Providers;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Illuminate\Support\ServiceProvider;

class DoctrineServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EntityManager::class, function ($app) {
            $path = $app->path() . "/Entity";
            $config = $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: array($path),
                isDevMode: env('DOCTRINE_DEV_MODE', false),
            );

            $connection = DriverManager::getConnection([
                'driver'   => env('DB_DRIVER', 'pdo_pgsql'),
                'user'     => env('DB_USERNAME', 'username'),
                'password' => env('DB_PASSWORD', 'password'),
                'dbname'   => env('DB_DATABASE', 'database'),
                'host'     => env('DB_HOST', 'localhost'),
                'port'     => env('DB_PORT', 5432),
            ], $config);

            return new EntityManager($connection, $config);
        });
    }
}