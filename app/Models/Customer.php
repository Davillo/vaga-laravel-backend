<?php

namespace App\Models;

use App\Constants\Customer\CustomerConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'image'
    ];

    function getImageAttribute($value){
        $filesDir = CustomerConstants::CUSTOMER_IMAGES_DIR;
        $appUrl = env('APP_URL');
        return  "{$appUrl}{$filesDir}{$value}";
    }
}
