<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\RandomModelInterface;

class Product extends Model implements  RandomModelInterface
{
    use HasFactory;

    public static function getRandom()
    {
        $data = self::inRandomOrder()->first(['title', 'SKU', 'image'])->toArray();
        $data['data_type'] = 'product';
        return $data;
    }
}
