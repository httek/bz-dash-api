<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class PermissionService extends Service
{
    /**
     * @var Model
     */
    protected static $model = Permission::class;

    /**
     * @param int $id
     * @param array $where
     * @return Role|null
     */
    public static function find(int $id, array $where = []): ?Permission
    {
        return static::model()->where($where)->find($id);
    }

    /**
     * @param array $condition
     * @return Role|null
     */
    public static function findByCondition(array $condition = []): ?Permission
    {
        return static::model()->where($condition)->first();
    }

    /**
     * @param array $where
     * @return Collection
     */
    public static function items(array $where = []): Collection
    {
        return static::model()->where($where)->get();
    }

    /**
     * @param int $id
     * @param array $where
     * @return bool
     */
    public static function destroy(int $id, array $where = []): bool
    {
        $where = array_merge($where, ['id' => $id]);

        return (bool) static::model()->where($where)->delete();
    }

    /**
     * @return Collection
     */
    public static function store(array $attributes): ?Permission
    {
        $item = static::model()->create($attributes);

        return $item->refresh();
    }

    /**
     * @param array $attributes
     * @param array $where
     * @return Role|null
     */
    public static function update(array $attributes, array $where = []): ?Permission
    {
        if (! $item = self::findByCondition($where)) {
            return null;
        }

        $item->update($attributes);

        return $item;
    }

    /**
     * @return array
     */
    public static function tree()
    {
        return static::model()
            ->linkable()
            ->latest('sequence')
            ->whereNull('parent')
            ->with('children')
            ->get();
    }


    /**
     * @param Admin $admin
     * @return \Illuminate\Support\Collection
     */
    public static function getPoolByAdmin(Admin $admin)
    {
        $model = static::model();
        if ($admin->isSuper()) {
            return $model->pluck('id');
        }

        if (! $admin->role) {
            return collect();
        }

        $pIds = $admin->role->permissions->pluck('id');

        return $model->whereIn('id', $pIds)->pluck('id');
    }
}
