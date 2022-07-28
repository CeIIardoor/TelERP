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
        \App\Models\User::factory()->create([
            'name' => 'Gestionnaire',
            'role' => 'Gestionnaire',
            'password' => bcrypt('password'),
            'email' => 'gestionnaire@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Administrateur',
            'role' => 'Administrateur',
            'password' => bcrypt('password'),
            'email' => 'admin@example.com',
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Organisation::factory(20)->create();
        \App\Models\Collaborateur::factory(100)->create();
        \App\Models\Forfait::factory(5)->create();
        \App\Models\Abonnement::factory(50)->create();
        \App\Models\Facture::factory(50)->create();
    }
}
