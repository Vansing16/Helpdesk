<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);
        DB::table('users')->insert([
            'name' => 'technician',
            'email' => 'technician@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'technician'
        ]);
        DB::table('admins')->insert([
            'name'=> 'admin',
            'email'=> 'admin@helpdesk.com',
            'password'=> Hash::make('12345678'),
        ]);
    }
}
