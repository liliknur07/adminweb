<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Member']
        ]);

        User::create([
            'name' => 'Admin',
            'last_name' => 'Minus',
            'email' => 'admin@gmail.com',
            'nik' => '007',
            'password' => Hash::make('007'),
            'role_id' => 1,
        ]);
    }
}
