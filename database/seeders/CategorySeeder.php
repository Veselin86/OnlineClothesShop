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
            ['name' => 'Pantalones', 'description' => 'Incluye jeans, pantalones de vestir y casuales para todas las ocasiones.'],
            ['name' => 'Blusas', 'description' => 'Variedad de blusas y camisas para el trabajo, eventos especiales y uso diario.'],
            ['name' => 'Faldas', 'description' => 'Desde minifaldas hasta faldas largas, encuentra estilos para cada temporada.'],
            ['name' => 'Trajes', 'description' => 'Trajes formales y conjuntos para el ámbito profesional y ocasiones importantes.'],
            ['name' => 'Accesorios', 'description' => 'Complementa tu estilo con nuestra selección de bolsos, joyas y más.']
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description']
            ]);
        }
    }
}
