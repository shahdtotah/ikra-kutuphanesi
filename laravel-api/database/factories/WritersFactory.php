<?php

namespace Database\Factories;
use App\Models\Writers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Writers>
 */
class WritersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Writers::class;
    public function definition(): array
    {
        $name = $this->faker->name();
        $birthdate = $this->faker->dateTimeBetween("-200 years","-30");
        $nationality = $this->faker->country();
        $biography = $this->faker->words(6, asText: true);
        $imagePath = $this->faker->imageUrl();
        return [
            "name"=> $name,
            "birthDate"=> $birthdate,
            "nationality"=> $nationality,
            "biography"=> $biography,
            "imagePath"=> $imagePath      //change
        ];
    }
}
