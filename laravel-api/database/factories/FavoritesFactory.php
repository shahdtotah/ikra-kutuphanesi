<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorites>
 */
class FavoritesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
                // 'writers_id' => Writers::factory(),
                // 'title'=> $this->faker->title,
                // 'category'=> $this->faker->randomElement(["scince","horror","Fantasy","history"]),
                // 'publication_date'=> $this->faker->dateTimeBetween("-150 years","now"),
                // 'summary'=> $this->faker->sentences(3, true),
                // 'imagePath'=> $this->faker->randomElement(["images/book1.jpg","images/book2.jpg","images/book3.jpg"]),
           
        ];
    }
}
