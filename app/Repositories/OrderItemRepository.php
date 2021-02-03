<?php

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository extends BaseRepository
{
    function __construct(OrderItem $orderItem = null)
    {
        parent::__construct($orderItem ?? new OrderItem());
    }
}