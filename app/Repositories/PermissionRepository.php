<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository
{
    /**
     * @param Permission $permissions
     */
    public function __construct(protected Permission $permissions)
    {
    }

    /**
     * @param Model $model
     * @param array|null $data
     * @return void
     */
    public function sync(Model $model, ?array $data): void
    {
        if ($data) {
            $syncIds = [];
            foreach ($data as $item) {
                $permission = Permission::firstOrCreate(['name' => $item]);
                $syncIds[] = $permission->id;
            }

            $model->permissions()->syncWithoutDetaching($syncIds);
        }
    }

    /**
     * @param Model $model
     * @return void
     */
    public function detach(Model $model): void
    {
        $model->permissions()->detach();
    }
}
