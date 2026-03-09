<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Ordinateurs portables',
                'description' => 'PC portables pour usage bureautique, professionnel et multimédia.'
            ],
            [
                'name' => 'PC de bureau',
                'description' => 'Ordinateurs fixes adaptés au travail, aux études et à un usage polyvalent.'
            ],
            [
                'name' => 'Composants PC',
                'description' => 'Cartes mères, processeurs, RAM, alimentations, cartes graphiques et autres composants.'
            ],
            [
                'name' => 'Écrans',
                'description' => 'Moniteurs pour bureautique, design, gaming et usage professionnel.'
            ],
            [
                'name' => 'Périphériques',
                'description' => 'Claviers, souris, webcams, casques et autres équipements externes.'
            ],
            [
                'name' => 'Stockage',
                'description' => 'Disques durs, SSD, clés USB et solutions de stockage externes.'
            ],
            [
                'name' => 'Équipements réseau',
                'description' => 'Routeurs, switchs, points d’accès, cartes réseau et accessoires de connectivité.'
            ],
            [
                'name' => 'Imprimantes',
                'description' => 'Imprimantes multifonctions, laser, jet d’encre et consommables associés.'
            ],
            [
                'name' => 'Accessoires informatiques',
                'description' => 'Câbles, supports, adaptateurs, housses et divers accessoires.'
            ],
            [
                'name' => 'Gaming',
                'description' => 'Produits informatiques orientés jeu : PC gaming, écrans, accessoires et composants.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        Category::create(['name' => 'Ordinateurs portables', 'description' => 'PC portables']);
    }
}