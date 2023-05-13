<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kategori_id' => random_int(1, 5),
            'nama' => $this->faker->words(2, true),
            'deskripsi' => $this->faker->sentence,
            'harga' => random_int(1000, 100000),
            'stok' => random_int(1, 100),
            'berat' => random_int(1, 1000)
        ];
    }
}
