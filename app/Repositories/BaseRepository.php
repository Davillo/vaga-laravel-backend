<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function __call($name, $args)
    {
        return $this->model->{$name}(...$args);
    }

    public function getById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function destroy($id):void
    {
        $model = $this->getById($id);
        $model->delete();
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->getById($id);
        $model->update($data);
        return $model;
    }

    public function exists(int $id): bool
    {
        return !!$this->getById($id);
    }

}