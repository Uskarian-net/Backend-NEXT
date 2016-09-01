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
        $swagger_callback_url = Config::get('app.url') . '/o2c.html';

        /** @var \Laravel\Passport\Client $swagger_client */
        $swagger_client = \Laravel\Passport\Client::where('name', 'Swagger')->where('redirect', $swagger_callback_url)->first();

        if (is_null($swagger_client)) {
            $swagger_client = $this->clients->create(null, 'Swagger', $swagger_callback_url);
        }

        $this->command->info('client_id: ' . $swagger_client->id);
        $this->command->info('client_secret: ' . $swagger_client->secret);
    }
}
