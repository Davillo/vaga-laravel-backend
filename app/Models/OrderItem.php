<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity'
    ];

    protected $appends = [
        'product'
    ];

    protected $hidden = [
        'product_id',
        'order_id'
    ];

    function getProductAttribute(){
        return Product::find($this->attributes['product_id'])->first();
    }
}
