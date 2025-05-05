<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OffreERP;
use App\Models\Admin;
class OffreERPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    

    public function run(): void
    {
        $adminId = Admin::first()->id;
    
        OffreERP::create([
            'admin_id' => $adminId,
            'nomOffre' => 'Silver',
            'prixOffre' => 150,
            'description' => 'Solution ERP pour petites entreprises.',
        ]);
    
        OffreERP::create([
            'admin_id' => $adminId,
            'nomOffre' => 'Gold',
            'prixOffre' => 300,
            'description' => 'Solution ERP complète pour PME.',
        ]);
    }
    

}
