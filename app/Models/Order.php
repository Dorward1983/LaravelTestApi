<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\RandomModelInterface;

class Order extends Model implements  RandomModelInterface
{
    use HasFactory;

    public static function getRandom()
    {
        $data = static::inRandomOrder()->first(['id', 'total', 'shipping_total', 'create_time', 'timezone'])->toArray();
        $data['data_type'] = 'order';
        return $data;
    }
}
