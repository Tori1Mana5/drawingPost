<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('user')->insert([
            'username' => Str::random(10),
            'display_name' => Str::random(5),
            'email' => Str::random(10) . 'gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
