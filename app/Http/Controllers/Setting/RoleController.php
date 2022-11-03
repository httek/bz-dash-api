<?php

namespace App\Http\Controllers\Setting;

use App\Http\Requests\Role\Update;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $items = RoleService::items();

        return success($items);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $item = RoleService::find($id);

        return $item ? success($item) : fail('Not found.');
    }

    /**
     * @param Update $request
     * @return JsonResponse
     */
    public function update(Update $request, int $id)
    {
        return success($request->all());
    }
}
