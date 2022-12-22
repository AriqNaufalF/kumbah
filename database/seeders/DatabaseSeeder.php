<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Member;
use App\Models\MemberType;
use App\Models\Service;
use App\Models\User;

use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::factory()->create([
            'name' => "Admin Kumbah",
            'gender' => mt_rand(1, 2),
            'address' => "Bandung",
            'phone' => "0822xxxxxxxx",
            'email' => "admin@kumbah.com",
            'password' => Hash::make("123456789"), // admin123
            'isAdmin' => true,
            'email_verified_at' => now(), 'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Employe
        User::factory(5)->create();

        MemberType::factory()->create([
            'name' => 'Silver',
            'price' => 10000,
            'discount' => 0.05,
        ]);

        MemberType::factory()->create([
            'name' => 'Gold',
            'price' => 15000,
            'discount' => 0.1,
        ]);

        MemberType::factory()->create([
            'name' => 'Platinum',
            'price' => 20000,
            'discount' => 0.15,
        ]);

        Member::factory(5)->create();

        Service::factory(3)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
