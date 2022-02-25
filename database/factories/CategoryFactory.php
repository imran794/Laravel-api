<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryName = $this->faker->text(10);
        return [
            'category_name'  => $categoryName,
            'category_slug'  => Str::slug($categoryName),
        ];
    }
}
