<?php

namespace App\Models;

use App\Constants\Product\ProductConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'price'
    ];


    function getImageAttribute($value){
        $filesDir = ProductConstants::PRODUCT_IMAGES_DIR;
        $appUrl = env('APP_URL');
        return  "{$appUrl}{$filesDir}{$value}";
    }
}
