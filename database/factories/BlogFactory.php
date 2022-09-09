<?php

namespace Database\Factories;

use App\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blod>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>$faker->company,
            'content'=>$faker->paragraph,
            'author_id'=>User::first()->id
        ];
    }


}