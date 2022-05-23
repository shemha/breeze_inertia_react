<?php

namespace Database\Factories;

// /reffect/breeze_inertia_react/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Factories/Factory.php
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // Factoryクラスのfakerメソッドを利用してダミーデータを定義
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->text,
        ];
    }
}
