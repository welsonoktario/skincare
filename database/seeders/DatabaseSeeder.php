<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Ekspedisi;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinsiSeeder::class,
            KotaSeeder::class,
        ]);

        Kategori::factory()
            ->count(5)
            ->create();

        User::factory()
            ->has(
                Toko::factory()
                    ->has(Barang::factory()->count(5), 'barangs')
                    ->count(1),
                'toko'
            )
            ->count(5)
            ->create();

        Ekspedisi::insert([
            'nama' => 'jne'
        ], [
            'nama' => 'pos'
        ], [
            'nama' => 'tiki'
        ]);
    }
}
