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
            'role' => 1
        ]);
    }
}
