<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Ekspedisi;
use App\Models\Kandungan;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        ]);

        Kategori::factory()
            ->count(6)
            ->create();

        User::factory()
            ->has(
                Toko::factory()
                    ->has(Barang::factory()->count(3), 'barangs')
                    ->count(1),
                'toko'
            )
            ->count(3)
            ->create();

        Kandungan::factory()
            ->count(3)
            ->create();

        Ekspedisi::insert([
            'nama' => 'jne'
        ], [
            'nama' => 'pos'
        ], [
            'nama' => 'tiki'
        ]);

        DB::table('interaksi_kandungans')
            ->insert([
                [
                    'kandungan_satu_id' => 1,
                    'kandungan_dua_id' => 2,
                    'jenis_interaksi' => 'baik',
                    'deskripsi_interaksi' => 'Baik aja',
                    'sumber' => 'Google'
                ],
                [
                    'kandungan_satu_id' => 1,
                    'kandungan_dua_id' => 3,
                    'jenis_interaksi' => 'buruk',
                    'deskripsi_interaksi' => 'Ga cocok',
                    'sumber' => 'Google'
                ],
                [
                    'kandungan_satu_id' => 2,
                    'kandungan_dua_id' => 3,
                    'jenis_interaksi' => 'tidak ada',
                    'deskripsi_interaksi' => 'Gapapa',
                    'sumber' => 'Google'
                ]
            ]);
    }
}
