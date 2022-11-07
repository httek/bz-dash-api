<?php

namespace App\Http\Requests\Role;

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
            'parent' => 'integer|exists:roles,id',
            'status' => 'integer|in:0,1',
            'remarks' => 'string|max:60'
        ];
    }
}
