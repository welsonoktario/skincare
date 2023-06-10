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
            'kategori_id' => random_int(1, 6),
            'nama' => $this->faker->realText(10),
            'deskripsi' => $this->faker->realText(),
            'harga' => ceil(random_int(1000, 100000)),
            'stok' => random_int(1, 100),
            'berat' => ceil(random_int(1, 1000))
        ];
    }
}
