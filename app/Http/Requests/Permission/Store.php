<?php

namespace App\Http\Requests\Permission;

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
            'title' => 'required|min:2',
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
