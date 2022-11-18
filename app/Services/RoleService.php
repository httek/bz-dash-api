<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleService extends Service
{
    /**
     * @var Model
     */
    protected static $model = Role::class;

    /**
     * @param int $id
     * @param array $where
     * @return Role|null
     */
    public static function find(int $id, array $where = []): ?Role
    {
        return static::model()->where($where)->find($id);
    }

    /**
     * @param array $condition
     * @return Role|null
     */
    public static function findByCondition(array $condition = []): ?Role
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
    public static function update(array $attributes, array $where = []): ?Role
    {
        if (! $item = self::findByCondition($where)) {
            return null;
        }

        $item->update($attributes);

        return $item;
    }

    // itemsWithPaginate

    /**
     * @param int $page
     * @param int $size
     * @param array $where
     * @param array $sort
     * @return LengthAwarePaginator
     */
    public static function itemsWithPaginate(int $page = 1, int $size = 15, array $where = [], array $sort = []): LengthAwarePaginator
    {
        $query = static::model()->with('permissions')->where($where);
        foreach ($sort as $filed => $order) {
            $ot = $order == 'desc' ? 'latest' : 'oldest';
            $query->{$ot}($filed);
        }

        return $query->paginate($size, '*', 'page', $page);
    }
}
