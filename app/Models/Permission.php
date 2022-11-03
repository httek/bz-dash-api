<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, RolePermission::class);
    }

    /**
     * @param $relations
     * @return array|string[]
     */
    public function getRelationsAttribute($relations): array
    {
        return array_map(static fn($id) => (int) $id, explode(',', $relations));
    }
}
