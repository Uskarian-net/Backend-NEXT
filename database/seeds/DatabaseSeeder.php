<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() !== 'development') {
            $this->call(OAuthSeeder::class);
            $this->call(RoleSeeder::class);
            $this->call(UserSeeder::class);
        }
    }
}
