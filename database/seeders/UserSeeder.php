<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> ea7f18e5f05b2033f4ad18e7733e67f617a8a3cd
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => hash::make('admin'),
            'role' => 'admin',
=======
        //
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'cust',
            'email' => 'cust@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'customer'
>>>>>>> ea7f18e5f05b2033f4ad18e7733e67f617a8a3cd
        ]);
    }
}
