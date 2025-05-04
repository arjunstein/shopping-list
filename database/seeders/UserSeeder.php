<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Arjunstein',
            'username' => 'arjun',
            'email' => 'arjun.gnw09@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make(env('USER_PASSWORD')),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Handika Resda Firdania',
            'username' => 'handika',
            'email' => 'resdahandika@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make(env('USER_PASSWORD')),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
