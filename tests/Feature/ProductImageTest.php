<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testProductHaveImage()
    {
        //Creamos un producto
        $product = Product::factory()->create();

        

    }
}
