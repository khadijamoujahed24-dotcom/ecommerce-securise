<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Ordinateurs portables
            ['name'=>'HP Pavilion 15 Ryzen 7 16Go 512Go SSD','description'=>'Laptop performant pour bureautique et multitâche','price'=>7890,'stock'=>6,'category_id'=>1,'image'=>'hp-pavilion-15.jpg'],
            ['name'=>'Lenovo IdeaPad 3 Intel Core i5 8Go 256Go SSD','description'=>'Laptop polyvalent pour usage quotidien','price'=>5490,'stock'=>8,'category_id'=>1,'image'=>'lenovo-ideapad-3.jpg'],

            // PC de bureau
            ['name'=>'Dell Optiplex Core i5 16Go 512Go SSD','description'=>'PC fixe pour usage professionnel','price'=>6590,'stock'=>4,'category_id'=>2,'image'=>'dell-optiplex.jpg'],
            ['name'=>'PC Gamer Ryzen 5 RTX 4060 16Go','description'=>'PC gamer pour jeu Full HD et multitâche','price'=>10990,'stock'=>5,'category_id'=>2,'image'=>'pc-gamer.jpg'],

            // Composants PC
            ['name'=>'Carte mère ASUS B550M-A','description'=>'Carte mère AMD socket AM4','price'=>1490,'stock'=>10,'category_id'=>3,'image'=>'asus-b550m.jpg'],
            ['name'=>'Barrette RAM Kingston 16Go DDR4','description'=>'Mémoire rapide pour PC et laptop','price'=>499,'stock'=>25,'category_id'=>6,'image'=>'ram-kingston.jpg'],

            // Cartes graphiques
            ['name'=>'Carte graphique NVIDIA GeForce RTX 4060 8Go','description'=>'Carte graphique performante pour gaming','price'=>4290,'stock'=>5,'category_id'=>4,'image'=>'rtx-4060.jpg'],
            ['name'=>'Carte graphique AMD RX 6600 8Go','description'=>'Carte graphique milieu de gamme','price'=>3690,'stock'=>6,'category_id'=>4,'image'=>'rx-6600.jpg'],

            // Processeurs
            ['name'=>'AMD Ryzen 7 5700X','description'=>'Processeur 8 cores / 16 threads','price'=>2390,'stock'=>8,'category_id'=>5,'image'=>'ryzen-7-5700x.jpg'],
            ['name'=>'Intel Core i5-12400','description'=>'Processeur Intel 6 cores / 12 threads','price'=>1990,'stock'=>10,'category_id'=>5,'image'=>'i5-12400.jpg'],

            // Écrans et moniteurs
            ['name'=>'LG UltraGear 27’’ 144Hz','description'=>'Moniteur gaming Full HD','price'=>3290,'stock'=>7,'category_id'=>7,'image'=>'lg-27-144hz.jpg'],
            ['name'=>'Samsung 24 pouces Full HD','description'=>'Écran bureautique polyvalent','price'=>1199,'stock'=>10,'category_id'=>7,'image'=>'samsung-24.jpg'],

            // Périphériques
            ['name'=>'Clavier Logitech K120 USB','description'=>'Clavier filaire simple et fiable','price'=>129,'stock'=>40,'category_id'=>8,'image'=>'logitech-k120.jpg'],
            ['name'=>'Souris Logitech M185 Sans fil','description'=>'Souris sans fil compacte','price'=>149,'stock'=>35,'category_id'=>8,'image'=>'logitech-m185.jpg'],

            // Réseau et connectivité
            ['name'=>'Routeur TP-Link Archer C6','description'=>'Routeur Wi-Fi double bande','price'=>449,'stock'=>12,'category_id'=>9,'image'=>'tplink-archer-c6.jpg'],

            // Imprimantes et scanners
            ['name'=>'HP DeskJet 2710','description'=>'Imprimante multifonction compacte','price'=>699,'stock'=>7,'category_id'=>10,'image'=>'hp-deskjet-2710.jpg'],

            // Accessoires informatiques
            ['name'=>'Sacoche laptop 15’’','description'=>'Sacoche pour transport sécurisé','price'=>199,'stock'=>30,'category_id'=>11,'image'=>'sacoche-laptop.jpg'],

            // Gaming
            ['name'=>'Souris Razer DeathAdder Essential','description'=>'Souris gaming ergonomique','price'=>329,'stock'=>14,'category_id'=>12,'image'=>'razer-deathadder.jpg'],

            // Logiciels et licences
            ['name'=>'Microsoft Office 365','description'=>'Licence annuelle pour bureautique','price'=>1090,'stock'=>20,'category_id'=>13,'image'=>'office-365.jpg'],

            // Batteries et alimentation
            ['name'=>'Alimentation Corsair 650W 80+ Bronze','description'=>'Alimentation PC fiable','price'=>699,'stock'=>10,'category_id'=>14,'image'=>'corsair-650w.jpg'],

            // Refroidissement
            ['name'=>'Ventilateur Noctua NF-P12','description'=>'Ventilateur pour boîtier PC','price'=>249,'stock'=>15,'category_id'=>15,'image'=>'noctua-nf-p12.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}