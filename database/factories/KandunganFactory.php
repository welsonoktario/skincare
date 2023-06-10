<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KandunganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->text(10, '1')
        ];
    }
}
