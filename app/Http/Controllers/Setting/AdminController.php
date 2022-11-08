<?php

namespace App\Http\Controllers\Setting;

use App\Services\AdminService;
use App\Http\Requests\Admin\Store;
use App\Http\Requests\Admin\Update;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $items = AdminService::itemsWithPaginate(
            ...$this->getPagingParams()
        );

        return $this->simplePaging($items);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $item = AdminService::find($id);

        return $item ? success($item) : fail('Not found.');
    }

    /**
     * @param Store $request
     * @return JsonResponse
     */
    public function store(Store $request)
    {
        $role = AdminService::store($request->validated());

        return $role ? success($role) : fail();
    }

    /**
     * @param Update $request
     * @return JsonResponse
     */
    public function update(Update $request, int $id)
    {
        $role = AdminService::update($request->validated(), compact('id'));

        return $role ? success($role) : fail();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        return AdminService::destroy($id) ? success() : fail();
    }
}
