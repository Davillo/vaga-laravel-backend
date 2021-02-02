<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    function __construct(Product $product = null)
    {
        parent::__construct($product ?? new Product());
    }
}