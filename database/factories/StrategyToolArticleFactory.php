<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StrategyToolArticle>
 */
class StrategyToolArticleFactory extends Factory
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
            'content' => '<p>' . implode('</p><br/><p>', fake()->paragraphs(20)) . '</p><br/>',
            'active' => rand(0, 1)
        ];
    }
}
