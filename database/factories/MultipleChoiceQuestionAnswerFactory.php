<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MultipleChoiceQuestionAnswer>
 */
class MultipleChoiceQuestionAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'answer' => fake()->words(rand(2, 7), true),
            'is_correct' => rand(0, 1)
        ];
    }
}
