<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Request;

class Update extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'min:2',
            'parent' => 'nullable|integer|exists:roles,id',
            'status' => 'integer|in:0,1',
            'remarks' => 'string|max:60'
        ];
    }
}
