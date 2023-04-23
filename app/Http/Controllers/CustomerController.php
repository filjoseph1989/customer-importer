<?php

namespace App\Http\Controllers;

use App\Entity\Customer;
use App\Imports\CustomerImporter;
use Doctrine\ORM\EntityManager;
use Laravel\Lumen\Http\Request;

class CustomerController extends Controller
{
    private object $importer;
    private object $entityManager;

    public function __construct(CustomerImporter $importer)
    {
        $this->importer = $importer;
        $this->entityManager = app(EntityManager::class);
    }

    /**
     * This method will display all customers record
     *
     * Note: This implementation is for the sake of expected 100 records, thus no pagination
     *       or hanler of many records
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $customerRepository = $this->entityManager->getRepository('App\Entity\Customer');
        $customers = $customerRepository->findAll();

        $customerResources  = [];

        foreach ($customers as $key => $customer) {
            $customerResources[] = [
                'full_name' => $customer->getFirst()." ".$customer->getLast(),
                'email'     => $customer->getEmail(),
                'country'   => $customer->getCountry()
            ];
        }

        return response()->json([
            'data' => $customerResources,
            '_links' => [
                'self' => route('list-imported-customer'),
                'show' => route('show-import-customer')
            ]
        ], 201);
    }

    /**
     * This method will return a single single record based
     * on the given ID
     *
     * @param int $customersId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($customersId)
    {
        $customer = $this->entityManager->find('App\Entity\Customer', $customersId);

        $customerResources = [];

        $customerResources[] = [
            'full_name' => $customer->getFirst() . " " . $customer->getLast(),
            'email'     => $customer->getEmail(),
            'username'  => $customer->getUsername(),
            'gender'    => $customer->getGender(),
            'country'   => $customer->getCountry(),
            'city'      => $customer->getCity(),
            'phone'     => $customer->getPhone(),
        ];

        return response()->json([
            'data' => $customerResources,
            '_links' => [
                'self' => route('show-import-customer'),
                'list-all-customers' => route('list-imported-customer'),
            ]
        ], 200);
    }

    /**
     * A method use to check if the content is a json
     *
     * @param object $request
     * @return boolean
     */
    private function isJsonRequest($request)
    {
        return $request->header('Content-Type') === 'application/json';
    }
}