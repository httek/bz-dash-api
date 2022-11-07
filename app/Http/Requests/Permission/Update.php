<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\Request;

class Update extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string|min:2',
            'title' => 'string|min:2',
            'path' => 'min:1',
            'icon' => 'nullable',
            'type' => 'in:0,1,2',
            'parent' => 'integer|exists:permissions,id',
            'sequence' => 'integer|min:0',
            'component' => 'nullable|string',
            'status' => 'integer|in:0,1',
            'remarks' => 'string|max:60'
        ];
    }
}
