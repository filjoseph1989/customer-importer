<?php

namespace Tests;

use DB;
use App\Entity\Customer;
use App\Imports\CustomerImporter;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\CustomerDefinition;
use Doctrine\ORM\EntityManager;

class FetchCustomerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * This is a test if the /customers endpoint is returning json
     *
     * @return void
     */
    public function test_customers_get_endpoint_returns_a_successful_response()
    {
        $entityManager = app(EntityManager::class);

        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $queryBuilder->delete(Customer::class, 'c')->getQuery();

        $result = $query->execute();

        $customerRepository = $entityManager->getRepository(Customer::class);

        $customers = $customerRepository->findAll();

        $this->assertCount(0, $customers);

        $this->seedTestData(5, 'define');

        $customers = $customerRepository->findAll();

        $this->assertCount(5, $customers);

        $response = $this->get('/api/v1/customers');
        $response
            ->seeStatusCode(201)
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'full_name',
                        'email',
                        'country',
                    ]
                ],
                '_links' => [
                    'self',
                    'show',
                ]
            ]);
    }

    /**
     * This is a test if the /customers/{customerId} endpoint is returning json
     *
     * @return void
     */
    public function test_customer_get_endpoint_returns_a_successful_response()
    {
        $entityManager = app(EntityManager::class);

        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $queryBuilder->delete(Customer::class, 'c')->getQuery();

        $result = $query->execute();

        $customerRepository = $entityManager->getRepository(Customer::class);

        $customers = $customerRepository->findAll();

        $this->assertCount(0, $customers);

        $this->seedTestData(1, 'define');

        $customer = $customerRepository->findOneBy([]);

        $response = $this->get('/api/v1/customers/'. $customer->getId());
        $response
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        "full_name",
                        "email",
                        "username",
                        "gender",
                        "country",
                        "city",
                        "phone"
                    ]
                ],
                '_links' => [
                    'self',
                    'list-all-customers',
                ]
            ]);
    }

    /**
     * This is a test that the command is updating existing record
     *
     * @return void
     */
    public function test_customer_update_record()
    {
        $entityManager = app(EntityManager::class);

        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $queryBuilder->delete(Customer::class, 'c')->getQuery();

        $result = $query->execute();

        $customerRepository = $entityManager->getRepository(Customer::class);

        $customers = $customerRepository->findAll();

        $this->assertCount(0, $customers);

        $this->seedTestData(2, 'repeat');

        $customers = $customerRepository->findAll();

        $this->assertCount(1, $customers);
    }

    /**
     * Provide fake data
     *
     * @param integer $count
     * @param string $method
     * @return void
     */
    private function seedTestData(int $count, $method=null)
    {
        if (is_null($method)) {
            return;
        }

        $customerDefinition = new CustomerDefinition(new CustomerImporter, $count);
        $customerDefinition->$method();
    }
}
