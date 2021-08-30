<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arTimezone = [
            'Europe/Sofia',
            'Europe/Minsk',
            'Europe/Warsaw',
            'America/Montreal',
            'Africa/Addis_Ababa'
        ];

        for ($i = 0; $i < 100; $i++) {
            $order = [
                'total' => $i + 10.46,
                'shipping_total' => $i + 0.4,
                'create_time' => time(),
                'timezone' => $arTimezone[rand(0, 4)],
            ];

            Order::factory()->create($order);
        }
    }
}
