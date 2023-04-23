<?php

namespace Tests;

use App\Imports\CustomerImporter;
use Faker\Factory as Faker;

class CustomerDefinition
{
    private object $importer;
    private string $basePath;
    private int $count;

    public function __construct(CustomerImporter $importer, $count=1)
    {
        $this->importer = $importer;
        $this->count = $count;
    }

    public function define()
    {
        $faker = Faker::create();

        for ($i = 0; $i < $this->count; $i++) {
            $data["results"][] = [
                "gender" => $faker->randomElement(['male', 'female']),
                "name" => [
                    "first" => $faker->firstName,
                    "last" => $faker->lastName,
                ],
                "location" => [
                    "city" => $faker->city,
                    "country" => "Australia",
                ],
                "email" => $faker->unique()->safeEmail,
                "login" => [
                    "username" => $faker->unique()->userName,
                    "password" => $faker->password,
                ],
                "phone" => $faker->phoneNumber,
                "nat" => "AU",
            ];
        }

        $this->importer->import($data);
    }

    public function repeat()
    {
        $faker = Faker::create();

        $dataRepeat = [
            "gender" => $faker->randomElement(['male', 'female']),
            "name" => [
                "first" => $faker->firstName,
                "last" => $faker->lastName,
            ],
            "location" => [
                "city" => $faker->city,
                "country" => "Australia",
            ],
            "email" => $faker->unique()->safeEmail,
            "login" => [
                "username" => $faker->unique()->userName,
                "password" => $faker->password,
            ],
            "phone" => $faker->phoneNumber,
            "nat" => "AU",
        ];

        for ($i = 0; $i < $this->count; $i++) {
            $data["results"][] = $dataRepeat;
        }

        $this->importer->import($data);
    }
}
