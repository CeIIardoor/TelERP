<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Forfait;

class ForfaitFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Forfait::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'intitule' => $this->faker->word,
            'description' => $this->faker->text,
            'type' => $this->faker->randomElement(['Mobile', 'Fixe', 'Fax', 'Internet']),
            'operateur' => $this->faker->randomElement(['IAM', 'ORANGE', 'INWI']),
        ];
    }
}
