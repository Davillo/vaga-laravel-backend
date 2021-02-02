<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    function __construct(Customer $customer = null)
    {
        parent::__construct($customer ?? new Customer());
    }
}