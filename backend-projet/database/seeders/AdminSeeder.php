<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run(): void
{
    Admin::create([
        'nomAdmin' => 'Admin Principal',
        'emailAdmin' => 'yansoft@gmail.com',
        'password' => Hash::make('yansoft123')
    ]);
}

}
