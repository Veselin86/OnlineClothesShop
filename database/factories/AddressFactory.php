<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'line_1' => $this->faker->streetAddress(),
            'line_2' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'post_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'addressable_id' => '',
            'addressable_type' => '',
        ];
    }
}
