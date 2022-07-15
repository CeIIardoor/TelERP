<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $intitules = array("Tel Fixe", "Tel Mobile", "Internet ADSL", "Fibre Optique");
        $count_intitules = count($intitules);
        $forfaits = array("Forfait limité", "Forfait illimité", "Forfait International");
        $count_forfaits = count($forfaits);

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'email' => 'test@example.com',
        ]);
        for ($i = 0; $i < 5; $i++) {
            DB::table('types_abonnements')->insert([
                'intitule' => $intitules[rand(0, $count_intitules-1)],
                'pricing' => rand(1,5).'00',
                'description' => $forfaits[rand(0, $count_forfaits-1)],
            ]);
        }
        \App\Models\Abonnement::factory(50)->create();
    }
}
