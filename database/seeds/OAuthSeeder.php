<?php

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class OAuthSeeder extends Seeder
{
    /**
     * @var ClientRepository
     */
    private $clients;

    /**
     * @param ClientRepository $clients
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $callback_url = Config::get('app.url') . '/v1';

        /** @var \Laravel\Passport\Client $swagger_client */
        $swagger_client = \Laravel\Passport\Client::where('name', 'Testing')->where('redirect', $callback_url)->first();

        if (is_null($swagger_client)) {
            $swagger_client = $this->clients->create(null, 'Testing', $callback_url);
        }

        $this->command->info('client_id: ' . $swagger_client->id);
        $this->command->info('client_secret: ' . $swagger_client->secret);
    }
}
