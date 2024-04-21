<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sale;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSaleAddressTest extends TestCase
{
    use RefreshDatabase;

    public function testSaleAddressMatchesUserAddress()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Crear una dirección para el usuario
        $address = Address::factory()->create([
            'addressable_id' => $user->id,
            'addressable_type' => User::class,
            'line_1' => '123 Fake St'
        ]);

        // Crear una venta para el usuario
        $sale = Sale::factory()->create([
            'user_id' => $user->id
        ]);

        // Asociar la dirección del usuario a la venta
        $saleAddress = $address->replicate();
        $saleAddress->addressable_id = $sale->id;
        $saleAddress->addressable_type = Sale::class;
        $saleAddress->save();

        // Obtener la dirección asociada a la venta desde la base de datos
        $fetchedSaleAddress = Address::where('addressable_id', $sale->id)
                                     ->where('addressable_type', Sale::class)
                                     ->first();

        // Afirmar que la dirección de la venta coincide con la dirección del usuario
        $this->assertEquals($address->line_1, $fetchedSaleAddress->line_1);
    }
}
