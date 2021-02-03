<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    function __construct(Order $order = null)
    {
        parent::__construct($order ?? new Order());
    }
}