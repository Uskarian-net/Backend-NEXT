<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \ATLauncher\Models\Role $admin_role */
        $admin_role = \ATLauncher\Models\Role::where('name', 'admin')->first();

        /** @var \ATLauncher\Models\User $admin_user */
        $admin_user = \ATLauncher\Models\User::where('username', 'admin')->first();

        if (is_null($admin_user)) {
            $admin_user = \ATLauncher\Models\User::create([
                'username' => 'admin',
                'email' => 'admin@localhost.com',
                'password' => Hash::make('password')
            ]);
        }

        if (!\ATLauncher\Models\RoleUser::where('user_id', $admin_user->id)->exists()) {
            \ATLauncher\Models\RoleUser::create([
                'user_id' => $admin_user->id,
                'role_id' => $admin_role->id,
                'created_by' => null
            ]);
        }
    }
}
