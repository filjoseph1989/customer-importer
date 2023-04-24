<?php

namespace App\Imports;

use Log;
use App\Entity\Customer;
use App\Imports\DataImporterInterface;
use Doctrine\ORM\EntityManager;
use Illuminate\Validation\Validator;

class CustomerImporter implements DataImporterInterface
{
    /**
     * This method allows importing customer records
     *
     * @param array $data
     * @return void
     */
    public function import(array $data)
    {
        if (!isset($data["results"])) {
            return;
        }

        $entityManager = app(EntityManager::class);

        foreach ($data["results"] as $customer) {
            if (self::validCustomer($customer)) {
                $customerRepository = $entityManager->getRepository(Customer::class);
                $existingCustomer = $customerRepository->findOneBy(['email' => $customer['email']]);

                if (is_null($existingCustomer)) {
                    $newCustomer = new Customer;
                    $newCustomer->setGender($customer['gender']);
                    $newCustomer->setFirst($customer['name']['first']);
                    $newCustomer->setLast($customer['name']['last']);
                    $newCustomer->setEmail($customer['email']);
                    $newCustomer->setUsername($customer['login']['username']);
                    $newCustomer->setPassword(md5($customer['login']['password']));
                    $newCustomer->setCity($customer['location']['city']);
                    $newCustomer->setCountry($customer['location']['country']);
                    $newCustomer->setPhone($customer['phone']);

                    $entityManager->persist($newCustomer);
                } else {
                    $existingCustomer->setEmail($customer['email']);
                    $entityManager->persist($existingCustomer);
                }

                // Update/Create table customers
                $entityManager->flush();

                if (is_null($existingCustomer)) {
                    $state = $entityManager->getUnitOfWork()->getEntityState($newCustomer);
                } else {
                    $state = $entityManager->getUnitOfWork()->getEntityState($existingCustomer);
                }

                assert($state == 1, "Failed to assert that saving state for customer is success");

                if ($state == 1) {
                    $message = "Successfully saved customer";
                } else {
                    $message = "An error occurred while saving customer";
                }

                if (!in_array(env('APP_ENV'), ['test', 'testing'])) {
                    Log::info("{$message} {$customer['email']}", [get_class($this)]);
                }
            } else {
                $email = isset($customer['email']) ? $customer['email'] : '';
                if (!in_array(env('APP_ENV'), ['test', 'testing'])) {
                    Log::info("Failed to add/update new customer {$email}", [get_class($this)]);
                }
            }
        }
    }

    /**
     * Don't trust even test data. check
     *
     * @param array $data
     * @return boolean
     */
    private function validCustomer(array $data)
    {
        if (in_array(env('APP_ENV'), ['test', 'testing'])) {
            return true;
        }

        $rules = [
            'gender' => 'required|in:male,female',
            'name.first' => 'required|string|min:2|max:50',
            'name.last' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:customers,email',
            'login.username' => 'required|string',
            'login.password' => 'required|string',
            'location.city' => 'required|string',
            'location.country' => 'required|string',
            'phone' => 'required|string|min:10|max:15',
        ];

        $validator = Validator($data, $rules);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}