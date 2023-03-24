<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dish::create(['name' => 'Lasanha', 'category' => 'Massa']);
        Dish::create(['name' => 'Bolo de Chocolate', 'category' => 'Sobremesa']);
    }
}
