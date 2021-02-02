<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRODUCT_IMAGES_DIR = '/storage/app/public/products/';

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'price'
    ];


    function getImageAttribute($value){
        $filesDir = self::PRODUCT_IMAGES_DIR;
        $appUrl = env('APP_URL');
        return  "{$appUrl}{$filesDir}{$value}";
    }
}
