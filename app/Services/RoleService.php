<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService extends Service
{
    /**
     * @param int $id
     * @param array $where
     * @return Role|null
     */
    public static function find(int $id, array $where = []): ?Role
    {
        return Role::where($where)->find($id);
    }

    /**
     * @param array $condition
     * @return Role|null
     */
    public static function findByCondition(array $condition = []): ?Role
    {
        return Role::where($condition)->first();
    }

    /**
     * @param array $where
     * @return Collection
     */
    public static function items(array $where = []): Collection
    {
        return Role::where($where)->get();
    }

    /**
     * @param int $id
     * @param array $where
     * @return bool
     */
    public static function destroy(int $id, array $where = []): bool
    {
        return (bool) Role::where($where)->delete($id);
    }

    /**
     * @return Collection
     */
    public static function store(array $attributes): ?Role
    {
        /** @var Role $role */
        $role = Role::create($attributes);

        return $role->refresh();
    }

    /**
     * @param array $attributes
     * @param array $where
     * @return Role|null
     */
    public static function update(array $attributes, array $where = []): ?Role
    {
        if (! $role = self::findByCondition($where)) {
            return null;
        }

        $role->update($attributes);

        return $role;
    }
}
