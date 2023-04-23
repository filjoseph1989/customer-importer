<?php

namespace App\Console\Commands;

use App\Imports\CustomerImporter;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CustomerImporterCommand extends Command
{
    private object $importer;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to import customers data and save them to the database.';

    public function __construct(CustomerImporter $importer)
    {
        parent::__construct();

        $this->importer = $importer;
    }

    /**
     * The artisan command calls the handle() method,
     * which initializes a HTTP client and makes a GET
     * request to the customer source API.
     */
    public function handle()
    {
        $client = new Client();

        $response = $client->request('GET', env('CUSTOMER_SOURCE_API'));

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $this->importer->import($data);
        } else {
            $error = $response->getBody();
            throw new \Exception($error['error'], 1);
        }
    }
}
