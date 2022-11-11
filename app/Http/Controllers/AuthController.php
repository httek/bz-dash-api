<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\PermissionService;
use App\Services\TokenService;
use App\Http\Requests\Auth\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param Login $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(Login $request)
    {
        $profile = AdminService::findByCondition(['mobile' => $request->input('mobile')]);
        if ($profile->isDisabled()) {
            return fail('Blocked.', 4012);
        }

        if (! Hash::check($request->input('password'), $profile->password)) {
            return fail('Invalid password.', 4013);
        }

        $token = TokenService::issue($profile, 1440 * 2);

        return success(compact('token', 'profile'));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function meta(Request $request)
    {
        $profile = $request->user();
        $tree = PermissionService::tree();
        $pool = PermissionService::getPoolByAdmin($profile);

        return success(compact('profile', 'tree', 'pool'));
    }
}
