<?php

namespace Database\Seeders;

use App\Models\Ekspedisi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'nama' => 'Admin',
            'no_hp' => '081234567890',
            'role' => 'admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$BbbHsZnyXeH0GLu9N4F5eOfSdCQrKKp2lAYCJbp07LeBGFixJGf5i', // 123
            'remember_token' => Str::random(10),
        ]);

        $this->call([
            ProvinsiSeeder::class,
            KotaSeeder::class,
            BankSeeder::class,
        ]);

        Ekspedisi::insert([
            ['nama' => 'jne'],
            ['nama' => 'pos'],
            ['nama' => 'tiki']
        ]);
    }
}
