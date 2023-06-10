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
            'foto' => $this->faker->imageUrl(150, 150),
            'nama' => $this->faker->company(),
            'deskripsi' => $this->faker->words(3, true),
            'no_telepon' => $this->faker->phoneNumber,
            'saldo' => 0,
        ];
    }
}
