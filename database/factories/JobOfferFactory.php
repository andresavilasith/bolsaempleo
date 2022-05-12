<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $response = array('activo', 'inactivo');
        $active_inactive = array_rand($response);
        return [
            'name' => $this->faker->unique()->name,
            'state' => $active_inactive
        ];
    }
}
