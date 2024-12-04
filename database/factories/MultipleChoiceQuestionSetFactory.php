<?php

namespace Database\Factories;

use App\Models\CourseTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MultipleChoiceQuestionSet>
 */
class MultipleChoiceQuestionSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $topic = CourseTopic::inRandomOrder()->first();
        $subtopic = CourseTopic::inRandomOrder()->first();

        return [
            'name' => ucwords(fake()->words(rand(4,10), true)),
            'minimum_percentage' => 10,
            'topic_id' => $topic->id,
            'subtopic_id' => $subtopic->id,
            'time_type' => rand(0,1) ? 'question' : 'set',
            'time_allowed' => rand(1, 10),
            'show_answer_sheet' => rand(0,1),
            'show_explanation' => rand(0,1)
        ];
    }
}
