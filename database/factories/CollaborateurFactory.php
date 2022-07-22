<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborateur>
 */
class CollaborateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->firstName,
            'prenom' => $this->faker->lastName,
            'derniere_affectation' => $this->faker->word,
            'ville' => $this->faker->city,
            'organisation_id' => rand(1,20),
            'CIN' => $this->faker->numerify('CIN######'),
            'dernier_grade' => $this->faker->word,
            'gestionnaire' => $this->faker->firstName,
            'derniere_province' => $this->faker->city,
            'n_client' => $this->faker->numerify('NCLI######'),
        ];
    }
}
