<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Facture;

class FactureFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Facture::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'abonnement_id' => rand(1,50),
            'date' => $this->faker->date(),
            'montant_supplementaire' => 0,
            'echeance' => $this->faker->date(),
            'statut' => $this->faker->randomElement(['Payée','En attente','Non payée']),
            'F_OHXACT' => $this->faker->numerify('F_OHXACT_######'),
            'F_CUSTCODE' => $this->faker->numerify('F_CUSTCODE_######'),
            'CUSTCODE' => $this->faker->numerify('CUSTCODE_######'),
            'DOHA' => $this->faker->numerify('DOHA_######'),
            'ND_SUP' => $this->faker->numerify('ND_SUP_######'),
            'LOGIN' => $this->faker->word,
            'REF_FACT' => $this->faker->numerify('REF_FACT_######'),
            'PRODUIT' => $this->faker->randomElement(['Telephone','Routeur','Fixe','Fax', 'Non']),
            'PL_TAR' => $this->faker->numerify('PL_TAR_######'),
            'DR' => $this->faker->numerify('DR_######'),
            'intrus' => $this->faker->numerify('intrus_######'),
            'justif' => 'justifs/'.$this->faker->word.'-'.$this->faker->date.'.pdf',
            'CMOTIF_RS' => $this->faker->word,
        ];
    }
}
