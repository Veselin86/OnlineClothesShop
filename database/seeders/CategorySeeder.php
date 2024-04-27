<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pantalones', 'description' => 'Incluye jeans, pantalones de vestir y casuales para todas las ocasiones.', 'image_url' => 'images/categories/pantalones.jpeg'],
            ['name' => 'Blusas', 'description' => 'Variedad de blusas y camisas para el trabajo, eventos especiales y uso diario.', 'image_url' => 'images/categories/blusas.jpeg'],
            ['name' => 'Faldas', 'description' => 'Desde minifaldas hasta faldas largas, encuentra estilos para cada temporada.', 'image_url' => 'images/categories/faldas.jpeg'],
            ['name' => 'Trajes', 'description' => 'Trajes formales y conjuntos para el ámbito profesional y ocasiones importantes.', 'image_url' => 'images/categories/trajes.jpeg'],
            ['name' => 'Accesorios', 'description' => 'Complementa tu estilo con nuestra selección de bolsos, joyas y más.', 'image_url' => 'images/categories/accesorios.jpeg']
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'image_url' => $category['image_url']
            ]);
        }
    }
}
