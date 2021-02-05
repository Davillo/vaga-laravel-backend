<?php

namespace App\Models;

use App\Constants\Customer\CustomerConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'image'
    ];

    function getImageAttribute($value){
        $filesDir = CustomerConstants::CUSTOMER_IMAGES_DIR_LINK;

        if(!$value){
            return '';
        }

        return url("$filesDir/{$value}");
    }
}
