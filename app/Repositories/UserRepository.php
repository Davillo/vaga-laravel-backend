<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    function __construct(User $user = null)
    {
        parent::__construct($user ?? new User());
    }
}