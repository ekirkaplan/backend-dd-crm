<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model;

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * @param Model $model
     * @param array $data
     * @return User
     */
    public function update(Model $model, array $data): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool;
}
