<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run(): void
{
    Client::create([
        'nomClient' => 'Mohamed Laarifi',
        'emailClient' => 'contact@gmail.com',
        'télé' => '0601020304',
        'société' => 'laarifi Société',
        'adresse' => 'casablanca maarif'
    ]);
}

}
