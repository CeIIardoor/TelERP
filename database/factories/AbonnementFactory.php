<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Abonnement;

class AbonnementFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Abonnement::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'collaborateur_id' => rand(0,10),
            'numero_ligne' => $this->faker->numerify('06-##-##-##-##'),
            'nom' => $this->faker->firstName(),
            'prenom' => $this->faker->lastName(),
            'derniere_affectation' => $this->faker->word,
            'ville' => $this->faker->word,
            'CIN' => $this->faker->word,
            'dernier_grade' => $this->faker->word,
            'type_abonnement' => rand(1,3),
            'type_forfait' => $this->faker->word,
            'operateur' => $this->faker->randomElement(['IAM', 'ORANGE', 'INWI']),
            'periode_engagement' => $this->faker->randomElement(['12', '24', '36']).' mois',
            'montant_forfait' => rand(0,5).$this->faker->randomElement(['00', '50']).' DH',
            'telephone' => $this->faker->randomElement(['Oui', 'Non']),
            'date_debut' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'date_cloture' => $this->faker->dateTimeBetween('now', '+3 years'),
            'gestionnaire' => $this->faker->name,
            'derniere_province' => $this->faker->region(),
            'commentaire' => $this->faker->text,
            'num_contrat_operateur' => $this->faker->numerify('#######'),
            'deleted_at' => rand(0,5) ? Null : $this->faker->dateTime(),
        ];
    }
}
