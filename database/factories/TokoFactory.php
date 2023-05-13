<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TokoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kota_id' => random_int(1, 501),
            'nama' => "Tokonya {$this->faker->name()}",
            'alamat' => $this->faker->address,
            'deskripsi' => $this->faker->words(3, true),
            'no_telepon' => $this->faker->phoneNumber,
            'saldo' => 0,
        ];
    }
}
