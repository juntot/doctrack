<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
use Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            [
                'firstName' => Str::random(10),
                'lastName' => Str::random(10),
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'user'
            ],
            [
                'firstName' => Str::random(10),
                'lastName' => Str::random(10),
                'email' => 'staff@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'staff'
            ],
            [
                'firstName' => Str::random(10),
                'lastName' => Str::random(10),
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'admin',
            ]
        ]);
    }
    // php artisan db:seed --class=UserSeeder
}
