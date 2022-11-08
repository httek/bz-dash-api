<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class Store extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'avatar' => 'string|url',
            'mobile' => 'required|string|max:11|min:11|unique:admins,mobile',
            'password' => 'required|string|min:6|max:30',
            'role_id' => 'integer|exists:roles,id',
            'status' => 'integer|in:0,1'
        ];
    }
}
