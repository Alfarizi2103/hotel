<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('users')->insert([
        'name'      => 'Admin',
        'email'     => 'admin@gmail.com',
        'role'      => '1',
        'password'  => Hash::make('wikrama2022')
    ]);
    DB::table('users')->insert([
        'name'      => 'User',
        'email'     => 'user@gmail.com',
        'role'      =>  '2',
        'password'  => Hash::make('wikrama2022')
    ]);
    DB::table('users')->insert([
        'name'      => 'Resepsionis',
        'email'     => 'resepsionis@gmail.com',
        'role'      =>  '3',
        'password'  => Hash::make('wikrama2022')
    ]);
    }
}
