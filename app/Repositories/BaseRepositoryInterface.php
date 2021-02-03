<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface{

    public function __call($name, $args);

    public function getById(int $id): ?Model;

    public function store(array $data): Model;

    public function destroy($id): void;

    public function update(int $id, array $data): Model;

    public function exists(int $id): bool;

}