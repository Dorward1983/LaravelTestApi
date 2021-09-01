<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\RandomModelInterface;

class Product extends Model implements RandomModelInterface
{
    use HasFactory;

    /**
     * @return array
     */
    public static function getRandom()
    {
        $data = static::inRandomOrder()->first(['title', 'SKU', 'image'])->toArray();
        $data['data_type'] = 'product';

        return $data;
    }
}
