<?php
namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class Login extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'mobile' => 'required|exists:admins,mobile',
            'password' => 'required|string|min:6|max:30'
        ];
    }
}
