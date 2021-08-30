<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $sku = 'SKU';

            if ($i < 10) {
                $sku .= '00' . $i;
            } else {
                $sku .= '0' . $i;
            }

            $product = [
                'SKU' => $sku,
                'title' => 'Demo' . $i,
                'image' => 'img/ryzhij_kote.jpg',
            ];

            Product::factory()->create($product);
        }
    }
}
