<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReflectiveJournalStep>
 */
class ReflectiveJournalStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => ucwords(fake()->words(4, true)),
            'order' => 0,
            'content' => fake()->words(20, true),
            'accept_input' => 1,
        ];
    }
}
