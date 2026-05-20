<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function find(int $id): ?Model;

    public function findOrFail(int $id): Model;

    public function create(array $data): Model;

    public function update(Model $model, array $data): Model;

    public function delete(Model $model): bool;
}
