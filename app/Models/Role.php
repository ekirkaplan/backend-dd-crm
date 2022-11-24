<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, HasActivity;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'status',
        'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permission', 'role_id', 'permission_id');
    }

//    /**
//     * @return BelongsToMany
//     */
//    public function menus(): BelongsToMany
//    {
//        return $this->belongsToMany(Menu::class, 'menu_has_role', 'role_id', 'menu_id');
//    }

    /**
     * @param string $permission
     * @return bool
     */
    public function hasAnyPermission(string $permission): bool
    {
        $permission = Permission::where('name', $permission)->first();
        if ($permission) {
            return $this->permissions()->where('permission_id', $permission->id)->exists();
        }
        return false;
    }
}
