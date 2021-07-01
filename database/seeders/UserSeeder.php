<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Pratham Maner',
            'email' => 'pratham@gmail.com',
            'password' => Hash::make('abcd1234')
        ]);

        User::create([
            'name' => 'Amaan Jambura',
            'email' => 'amaanjambura@studylink.com',
            'password' => Hash::make('abcd1234')
        ]);

        User::create([
            'name' => 'Devesh Ahuja',
            'email' => 'deveshahuja12@gmail.com',
            'password' => Hash::make('abcd1234')
        ]);
    }
}
