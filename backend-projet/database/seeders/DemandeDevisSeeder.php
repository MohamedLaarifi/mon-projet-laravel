<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DemandeDevis;
class DemandeDevisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

public function run(): void
{
    DemandeDevis::create([
        'typeService' => 'Développement ERP',
        'detailsProjet' => 'Nous souhaitons intégrer un ERP pour gérer les stocks et RH.',
        'budgetEstime' => 3000,
        'datelimite' => now()->addDays(10),
        'client_id' => 1,
        'admin_id' => 1
    ]);
}

}
