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
            'collaborateur_id' => rand(1,100),
            'numero_ligne' => $this->faker->numerify('06-##-##-##-##'),    
            'forfait_id' => rand(1,5),
            'periode_engagement' => $this->faker->randomElement([12,24,36,48,60]),
            'mensualite' => $this->faker->randomElement([100, 150, 200, 250, 300, 500]),
            'produit' => $this->faker->randomElement(['Telephone','Routeur','Fixe','Fax', 'Non']),
            'date_debut' => $this->faker->date(),
            'date_cloture' => $this->faker->date(),
            'commentaire' => $this->faker->text,
            'num_contrat_operateur' => $this->faker->numerify('N_#######'),
        ];
    }
}
