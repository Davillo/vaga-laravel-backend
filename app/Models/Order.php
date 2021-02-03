<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'total'
    ];

    protected $appends = [
        'customer'
    ];

    protected $hidden = [
        'customer_id'
    ];

    public function getCustomerAttribute(){
        return Customer::find($this->attributes['customer_id'])->first();
    }
}
