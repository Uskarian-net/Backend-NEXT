<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\ATLauncher\Models\Role::where('name', 'admin')->exists()) {
            \ATLauncher\Models\Role::create([
                'name' => 'admin',
                'description' => 'An admin to the ATLauncher system',
                'rate_limit' => 600,
                'created_by' => null
            ]);
        }
    }
}
