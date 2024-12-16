<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'superAdmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin123')
        ])->assignRole('superAdmin');

        //barangay admin account
        User::create([
            'name' => 'bosongon',
            'email' => 'bosongon@gmail.com',
            'barangay_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789')
        ])->assignRole('admin');
        User::create([
            'name' => 'cabulijan',
            'email' => 'cabulijan@gmail.com',
            'barangay_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789')
        ])->assignRole('admin');

        //barangay user account
        User::create([
            'name' => 'bosongonuser',
            'email' => 'bosongonuser@gmail.com',
            'barangay_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789')
        ])->assignRole('user');
        User::create([
            'name' => 'cabulijanuser',
            'email' => 'cabulijanuser@gmail.com',
            'barangay_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789')
        ])->assignRole('user');
        User::create([
            'name' => 'talencerasuser',
            'email' => 'talencerasuser@gmail.com',
            'barangay_id' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789')
        ])->assignRole('user');
        User::create([
            'name' => 'tinangnanuser',
            'email' => 'tinangnanuser@gmail.com',
            'barangay_id' => 4,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789')
        ])->assignRole('user');
    }
}
