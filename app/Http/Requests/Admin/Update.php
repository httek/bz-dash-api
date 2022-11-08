<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Models\Admin;

class Update extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'min:2',
            'avatar' => 'string|url',
            'mobile' => 'string|max:11|min:11|unique:admins,mobile,' . Admin::where('id', $this->route('id'))->value('id'),
            'password' => 'string|min:6|max:30',
            'status' => 'integer|in:0,1'
        ];
    }
}
