<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    /**
     * @var Model
     */
    protected static $model = null;

    /**
     * @return Model|string
     */
    protected static function model()
    {
        return new static::$model;
    }
}
