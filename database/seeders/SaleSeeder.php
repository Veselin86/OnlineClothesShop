<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                $sale = Sale::create([
                    'user_id' => $user->id,
                    'date' => now(),
                    'total' => 0,
                    'status' => 'completed'
                ]);

                $products = Product::inRandomOrder()->take(rand(1, 3))->get();
                $total = 0;
                foreach ($products as $product) {
                    $totalPriceProduct = 0;
                    if ($product->sizes != null) {
                        $size = $product->sizes[array_rand($product->sizes)];
                    }
                    if ($product->colors != null) {
                        $color = $product->colors[array_rand($product->colors)];
                    }
                    $quantity = rand(1, 3);
                    $price = $product->price * $quantity;
                    $totalPriceProduct += $price;
                    $total += $price;

                    $sale->products()->attach($product->id, ['quantity' => $quantity, 'price' => $product->price, 'total' => $totalPriceProduct, 'size' => $size, 'color' => $color]);
                }

                $sale->total = $total;
                $sale->save();
            }
        }
    }
}
