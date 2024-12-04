<?php

namespace Database\Factories;

use App\Models\CourseTopic;
use App\Models\CourseType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => ucwords(fake()->words(3, true)),
            'description' => '<p>' . implode('</p><br/><p>', fake()->paragraphs(20)) . '</p><br/>',
            'trainer_id' => (User::query()->trainers()->inRandomOrder()->first())->id,
            'course_topic_id' => (CourseTopic::query()->inRandomOrder()->first())->id,
            'course_type_id' => (CourseType::query()->inRandomOrder()->first())->id,
            'duration' => rand(30, 120),
            'view_scope' => rand(0,1),
            'active' => rand(0, 1)
        ];
    }
}
