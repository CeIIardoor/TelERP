<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organisation;

class OrganisationFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Organisation::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'intitule' => $this->faker->word(5),
            'sigle' => strtoupper($this->faker->word),
            'ville' => $this->faker->city,
            'n_client' => $this->faker->numerify('NCLI######'),
            'region' => $this->faker->region,
            'code postal' => $this->faker->numerify('#####'),
            'email' => $this->faker->safeEmail,
            'adresse' => $this->faker->address,
        ];
    }
}
