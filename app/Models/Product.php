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

    protected $appends = [
        'category'
    ];

    protected $hidden = [
        'category_id'
    ];

    function getCategoryAttribute(){
        return Category::find($this->attributes['category_id'])->first();
    }

    function getImageAttribute($value){
        $filesDir = ProductConstants::PRODUCT_IMAGES_DIR_LINK;

        if(!$value){
            return '';
        }

        return url("$filesDir/{$value}");
    }
}
