<?php

namespace Database\Factories;

use App\Models\Books;
use App\Models\Writers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Books::class;
    public function definition(): array
    {

        return [
            'writers_id' => Writers::factory(),
            'title'=> $this->faker->title,
            'category'=> $this->faker->randomElement(["scince","horror","Fantasy","history"]),
            'publication_date'=> $this->faker->dateTimeBetween("-150 years","now"),
            'summary'=> $this->faker->sentences(3, true),
            'imagePath'=> $this->faker->randomElement(["images/book1.jpg","images/book2.jpg","images/book3.jpg"]),
        ];
    }
}
