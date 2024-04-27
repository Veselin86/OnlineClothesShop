<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            'Pantalones' => [
                ['name' => 'Jeans Clásicos', 'description' => 'Jeans rectos y cómodos, ideales para el día a día.', 'price' => 60.00, 'stock' => 25, 'image' => 'images/products/jeans_clasicos.jpeg'],
                ['name' => 'Pantalones Chinos', 'description' => 'Perfectos para la oficina o una salida casual.', 'price' => 45.00, 'stock' => 30, 'image' => 'images/products/pantalones_chinos.jpeg'],
                ['name' => 'Pantalones de Carga', 'description' => 'Robustos y versátiles, con múltiples bolsillos.', 'price' => 50.00, 'stock' => 20, 'image' => 'images/products/pantalones_carga.jpeg']
            ],
            'Blusas' => [
                ['name' => 'Blusa de Seda', 'description' => 'Elegante y sofisticada, perfecta para eventos formales.', 'price' => 70.00, 'stock' => 15, 'image' => 'images/products/blusa_seda.jpeg'],
                ['name' => 'Blusa Casual', 'description' => 'Ideal para el día a día, ligera y fresca.', 'price' => 35.00, 'stock' => 40, 'image' => 'images/products/blusa_casual.jpeg'],
                ['name' => 'Blusa de Denim', 'description' => 'Duradera y de moda, un must-have en tu armario.', 'price' => 55.00, 'stock' => 25, 'image' => 'images/products/blusa_denim.jpeg']
            ],
            'Faldas' => [
                ['name' => 'Falda Lápiz', 'description' => 'Falda lápiz clásica, perfecta para el trabajo y eventos formales.', 'price' => 40.00, 'stock' => 20, 'image' => 'images/products/falda_lapiz.jpeg'],
                ['name' => 'Falda Midi Plisada', 'description' => 'Elegante y femenina, ideal para salidas diurnas o eventos especiales.', 'price' => 45.00, 'stock' => 15, 'image' => 'images/products/falda_midi_plisada.jpeg'],
                ['name' => 'Mini Falda de Denim', 'description' => 'Versátil y moderna, combina bien con cualquier estilo casual.', 'price' => 35.00, 'stock' => 30, 'image' => 'images/products/mini_falda_denim.jpeg']
            ],
            'Trajes' => [
                ['name' => 'Traje de Negocios', 'description' => 'Traje formal en corte slim para una apariencia profesional y pulida.', 'price' => 150.00, 'stock' => 10, 'image' => 'images/products/traje_negocios.jpeg'],
                ['name' => 'Blazer y Pantalón', 'description' => 'Conjunto perfecto para el trabajo o eventos importantes, disponible en varios colores.', 'price' => 120.00, 'stock' => 12, 'image' => 'images/products/blazer_y_pantalon.jpeg'],
                ['name' => 'Traje con Falda', 'description' => 'Traje elegante con falda, ideal para negocios o ceremonias formales.', 'price' => 130.00, 'stock' => 8, 'image' => 'images/products/traje_con_falda.jpeg']
            ],
            'Accesorios' => [
                ['name' => 'Bolsa de Cuero', 'description' => 'Bolsa de cuero elegante y espaciosa.', 'price' => 90.00, 'stock' => 25, 'image' => 'images/products/bolsa_cuero.jpeg'],
                ['name' => 'Cinturón de Vestir', 'description' => 'Cinturón de cuero fino, perfecto para añadir un toque clásico a cualquier traje.', 'price' => 30.00, 'stock' => 40, 'image' => 'images/products/cinturon_vestir.jpeg'],
                ['name' => 'Pañuelo de Seda', 'description' => 'Pañuelo de seda colorido, un accesorio versátil que eleva cualquier atuendo.', 'price' => 25.00, 'stock' => 50, 'image' => 'images/products/panuelo_ceda.jpeg']
            ]
        ];

        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

        $colors = ['Negro', 'Blanco', 'Rojo', 'Azul'];

        foreach ($categories as $category) {
            if ($category->name === 'Accesorios') {
                foreach ($products[$category->name] as $product) {
                    Product::create([
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'colors' => $colors,
                        'category_id' => $category->id,
                        'provider_id' => random_int(1, 5),
                        'image' => $product['image']
                    ]);
                }
            } else {
                foreach ($products[$category->name] as $product) {
                    Product::create([
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'sizes' => $sizes,
                        'colors' => $colors,
                        'category_id' => $category->id,
                        'provider_id' => random_int(1, 5),
                        'image' => $product['image']
                    ]);
                } 
            }
        }
    }
}
