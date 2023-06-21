<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotebookEntry>
 */
class NotebookEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name,
            'last_name' => fake()->lastName,
            'phone_number' => fake()->phoneNumber,
            'email' => fake()->email,
        ];
    }
}
