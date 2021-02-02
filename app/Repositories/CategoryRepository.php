<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    function __construct(Category $category = null)
    {
        parent::__construct($category ?? new Category());
    }
}