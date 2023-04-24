# Flexisource Importer API

Flexisource API is a RESTful API that utilizes the Lumen framework and Doctrine to import customers from external resources. It provides a simple and straightforward implementation of the API, allowing for easy integration with other systems.

## Installation

For installation just follow the official guidelines from Lumen documentation [Lumen](https://lumen.laravel.com/docs/10.x/installation)

Then serve

    php -S localhost:8000 -t public

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

## Endpoints

This implementation has two available endpoints, the base endpoint or prefix

    /api/v1

and the two segments available are

    GET /customers
    GET /customers/{customersId}

so to test, used API client and make a request like to get all customers

    /api/v1/customers

Example result will be

    {
        "data": [
            {
                "full_name": "Clarence Daniels",
                "email": "clarence.daniels@example.com",
                "country": "Australia"
            },
            {
                "full_name": "Dwight King",
                "email": "dwight.king@example.com",
                "country": "Australia"
            },

            ...
        ],
        "_links": {
            "self": "http://localhost:8000/api/v1/customers",
            "show": "http://localhost:8000/api/v1/customers/{customersId}"
        }
    }

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

