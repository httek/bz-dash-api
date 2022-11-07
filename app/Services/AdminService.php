<?php

namespace App\Services;

use App\Models\Admin;

class AdminService extends Service
{
    /**
     * @param int $id
     * @return Admin|null
     */
    public static function find(int $id): ?Admin
    {
        return null;
    }
}
