<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    abstract protected function model(): string;

    public function find(int $id): ?Model
    {
        return ($this->model())::find($id);
    }

    public function findOrFail(int $id): Model
    {
        $model = $this->find($id);

        if ($model === null) {
            throw (new ModelNotFoundException)->setModel($this->model(), $id);
        }

        return $model;
    }

    public function create(array $data): Model
    {
        return ($this->model())::create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function delete(Model $model): bool
    {
        try {
            return (bool) $model->delete();
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }
}
