<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ToolResourceArticle>
 */
class ToolResourceArticleFactory extends Factory
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
            'subtitle' => ucwords(fake()->words(6, true)),
            'content' => '<p>' . implode('</p><br/><p>', fake()->paragraphs(20)) . '</p><br/>',
            'format' => 'TEXT',
            'active' => rand(0, 1)
        ];
    }
}
