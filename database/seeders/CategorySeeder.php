<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Ordinateurs portables'],
            ['name' => 'PC de bureau'],
            ['name' => 'Composants PC'],
            ['name' => 'Cartes graphiques'],
            ['name' => 'Processeurs'],
            ['name' => 'Écrans et moniteurs'],
            ['name' => 'Périphériques'],
            ['name' => 'Réseau et connectivité'],
            ['name' => 'Imprimantes et scanners'],
            ['name' => 'Accessoires informatiques'],
            ['name' => 'Gaming'],
            ['name' => 'Logiciels et licences'],
            ['name' => 'Batteries et alimentation'],
            ['name' => 'Refroidissement'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}