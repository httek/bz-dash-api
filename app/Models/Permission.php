<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static ofType(array $type = [0])
 */
class Permission extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $casts = ['relations' => 'json'];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, RolePermission::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOfType($query, array $type = [0])
    {
        return $query->whereIn('type', $type);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLinkable($query)
    {
        return $this->ofType([0, 1]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grandChildren()
    {
        return $this->hasMany(self::class,'parent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->grandChildren()->with('children');
    }

    /**
     * @param $relations
     * @return void
     */
    public function getRelationsAttribute()
    {
        $relations = [$this->getKey()];
        $pId = $this->getAttributeValue('parent') ?: 0;
        while ($pId > 0) {
            array_unshift($relations, $pId);
            $pId = self::where('id', $pId)->value('parent') ?? 0;
        }

        return $relations;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentNode()
    {
        return $this->hasOne(self::class, 'parent');
    }
}
