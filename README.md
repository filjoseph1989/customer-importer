# Flexisource Importer API

Flexisource API is a RESTful API that utilizes the Lumen framework and Doctrine to import customers from external resources. It provides a simple and straightforward implementation of the API, allowing for easy integration with other systems.

## Installation

For installation just follow the official guidelines from Lumen documentation [Lumen](https://lumen.laravel.com/docs/10.x/installation)

Next, run migration using

    php artisan migrate

Next, set your preferred database connection in the .env

    DB_DRIVER=pdo_pgsql
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=databasename
    DB_USERNAME=username
    DB_PASSWORD=password

    DOCTRINE_DEV_MODE=true
    CUSTOMER_SOURCE_API=https://randomuser.me/api?nat=AU&format=json&results=1

Next, run the command

    php artisan import:customers

## Testing

Before running the unit test, make sure that below is set in the env

    APP_ENV=test

Run the command

    vendor/bin/phpunit

File that contains test cases

    tests/FetchCustomerTest.php

See videos

https://youtu.be/GViO8aVn608 <br>
https://youtu.be/-n3y_-unO7s - running the feature test


# Creator

Fil Joseph Elman <br>
https://filjoseph1989.github.io

