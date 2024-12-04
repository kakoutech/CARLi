<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MultipleChoiceQuestion>
 */
class MultipleChoiceQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'multiple_choice_question_set_id' => null,
            'type' => 'multiple',
            'marks' => rand(10,40),
            'image_path' => null,
            'question' => ucwords(fake()->words(10, true)),
            'explanation' => ucfirst(fake()->words(50, true))
        ];
    }
}
