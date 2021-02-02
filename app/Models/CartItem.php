<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cart_id',
        'quantity'
    ];
}
