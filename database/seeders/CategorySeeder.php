<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Ordinateurs portables', 'image' => 'pc portable.jpg',],
            ['name' => 'PC de bureau', 'image' => 'pc portable.jpg',],
            ['name' => 'Composants PC', 'image' => 'composants pc.jpg',],
            ['name' => 'Cartes graphiques', 'image' => 'carte graphique.jpg',],
            ['name' => 'Processeurs', 'image' => 'cpu.jpg'],
            ['name' => 'Écrans et moniteurs'],
            ['name' => 'Périphériques'],
            ['name' => 'Réseau et connectivité'],
            ['name' => 'Imprimantes et scanners'],
            ['name' => 'Accessoires informatiques'],
            ['name' => 'Gaming'],
            ['name' => 'Logiciels et licences'],
            ['name' => 'Batteries et alimentation'],
            ['name' => 'Refroidissement', 'image' => 'refroidissement.jpg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}