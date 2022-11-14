<?php

namespace App\Http\Controllers\Setting;

use App\Http\Requests\Permission\Store;
use App\Http\Requests\Permission\Update;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function tree()
    {
        $items = PermissionService::menus();

        return success($items);
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $items = PermissionService::items();

        return success($items);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $item = PermissionService::find($id);

        return $item ? success($item) : fail('Not found.');
    }

    /**
     * @param Store $request
     * @return JsonResponse
     */
    public function store(Store $request)
    {
        $item = PermissionService::store($request->validated());

        return $item ? success($item) : fail();
    }

    /**
     * @param Update $request
     * @return JsonResponse
     */
    public function update(Update $request, int $id)
    {
        $item = PermissionService::update($request->validated(), compact('id'));

        return $item ? success($item) : fail();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        return PermissionService::destroy($id) ? success() : fail();
    }
}
