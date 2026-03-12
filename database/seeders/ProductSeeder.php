<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'HP EliteBook 840 G5',
                'description' => 'Ordinateur portable professionnel avec processeur Intel Core i5, 8 Go de RAM et SSD 256 Go.',
                'price' => 8500,
                'stock' => 10,
                'category_id' => 1,
            ],
            [
                'name' => 'Dell Latitude 5490',
                'description' => 'PC portable fiable pour bureautique, navigation web et tâches quotidiennes.',
                'price' => 7900,
                'stock' => 12,
                'category_id' => 1,
            ],
            [
                'name' => 'Dell OptiPlex 7080',
                'description' => 'PC de bureau performant pour bureautique, gestion et environnement professionnel.',
                'price' => 7200,
                'stock' => 7,
                'category_id' => 2,
            ],
            [
                'name' => 'AMD Ryzen 5 5600X',
                'description' => 'Processeur performant pour bureautique avancée, gaming et création.',
                'price' => 2400,
                'stock' => 16,
                'category_id' => 3,
            ],
            [
                'name' => 'Écran Samsung 24 pouces',
                'description' => 'Moniteur Full HD offrant une bonne qualité d’affichage pour le travail.',
                'price' => 1900,
                'stock' => 13,
                'category_id' => 4,
            ],
            [
                'name' => 'Clavier Logitech K120',
                'description' => 'Clavier filaire simple, robuste et économique.',
                'price' => 120,
                'stock' => 40,
                'category_id' => 5,
            ],
            [
                'name' => 'SSD Kingston 500 Go',
                'description' => 'Disque SSD rapide pour démarrage système et stockage quotidien.',
                'price' => 480,
                'stock' => 25,
                'category_id' => 6,
            ],
            [
                'name' => 'Routeur TP-Link Archer C6',
                'description' => 'Routeur Wi-Fi performant pour maison ou petit bureau.',
                'price' => 520,
                'stock' => 14,
                'category_id' => 7,
            ],
            [
                'name' => 'Imprimante HP LaserJet',
                'description' => 'Imprimante laser rapide pour usage bureautique et administratif.',
                'price' => 2100,
                'stock' => 9,
                'category_id' => 8,
            ],
            [
                'name' => 'Disque dur externe Toshiba 1 To',
                'description' => 'Support de stockage externe compact pour sauvegardes et mobilité.',
                'price' => 650,
                'stock' => 16,
                'category_id' => 9,
            ],
            [
                'name' => 'Écran Asus Gaming 144Hz',
                'description' => 'Moniteur gaming fluide destiné aux joueurs exigeants.',
                'price' => 3200,
                'stock' => 8,
                'category_id' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}