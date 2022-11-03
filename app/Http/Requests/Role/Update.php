<?php

namespace App\Http\Requests\Role;

use Anik\Form\FormRequest;

class Update extends FormRequest
{
    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
