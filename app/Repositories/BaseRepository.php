<?php

namespace App\Repositories;

use App\Interfaces\Base\DestroyInterface;
use App\Interfaces\Base\AllInterface;
use App\Interfaces\Base\ShowInterface;
use App\Interfaces\Base\StoreInterface;
use App\Interfaces\Base\UpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements AllInterface, ShowInterface, StoreInterface, UpdateInterface, DestroyInterface
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->query()->get();
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model
    {
        return $model;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        $data['password'] = bcrypt($data['password']);
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool
    {
        return $model->delete();
    }
}
