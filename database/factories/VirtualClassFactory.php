<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use App\Models\VirtualClassCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VirtualClass>
 */
class VirtualClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        switch (rand(0, 1)) {
            case 0:
                $class_type = 'single';
                $recurrence = null;
                break;
            case 1:
                $class_type = 'recurring';
                $recurrence = rand(0, 1) ? 'monthly' : 'weekly';
                break;
        }

        return [            //
            'title' => fake()->words(5, true),
            'description' => fake()->words(20, true),
            'trainer_id' => (User::query()->trainers()->inRandomOrder()->first())->id,
            'duration' => rand(30, 360),
            'virtual_class_category_id' => (VirtualClassCategory::inRandomOrder()->first())->id,
            'icon_path' => null,
            'thumbnail_path' => null,
            'language_id' => (Language::inRandomOrder()->first())->id,
            'class_type' => $class_type,
            'recurrence' => $recurrence,
            'start_date' => now()->addHours(rand(100, 700)),
            'end_date' => now()->addHours(rand(1000, 2000)),
            'start_time' => rand(9, 17) . ':' . rand(0, 59),
            'host' => fake()->url(),
            'trainer_password' => fake()->words(1, true),
            'attendee_password' => fake()->words(1, true),
            'view_scope' => rand(0, 1),
            'active' => rand(0, 1),
        ];
    }
}
