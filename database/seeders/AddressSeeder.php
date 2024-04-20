<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Provider;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Address::factory()->create([
                'addressable_id' => $user->id,
                'addressable_type' => User::class
            ]);
        }

        $providers = Provider::all();
        foreach ($providers as $provider) {
            Address::factory()->create([
                'addressable_id' => $provider->id,
                'addressable_type' => Provider::class
            ]);
        }

        $sales = Sale::all();
        foreach ($sales as $sale) {
            $userAddress = $sale->user->addresses->first();
            if ($userAddress) {
                Address::factory()->create([
                    'addressable_id' => $sale->id,
                    'addressable_type' => Sale::class,
                    'line_1' => $userAddress->line_1,
                    'line_2' => $userAddress->line_2,
                    'city' => $userAddress->city,
                    'post_code' => $userAddress->post_code,
                    'country' => $userAddress->country
                ]);
            }
        }
    }
}
