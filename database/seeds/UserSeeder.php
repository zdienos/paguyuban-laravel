<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'full_name'=> 'z mardino santosa',
            'email' => 'admin@admin.com',
            'password' => bcrypt('asdasd'),
            'role' => 3
        ]);
        User::create([
            'username' => 'user',
            'full_name'=> 'user mardino',
            'email' => 'user@user.com',
            'password' => bcrypt('asdasd'),
            'role' => 1
        ]);
    }
}
