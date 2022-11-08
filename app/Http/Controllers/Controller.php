<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param Request $request
     * @return array
     */
    public function getPagingParams(Request $request = null): array
    {
        if (is_null($request)) {
            $request = \Illuminate\Support\Facades\Request::instance();
        }

        return [
            $request->get('page', 1),
            $request->get('size', 15)
        ];
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function simplePaging(LengthAwarePaginator $paginator)
    {
        $result = [
            'data' => $paginator->items(),
            'size' => $paginator->perPage(),
            'total' => $paginator->count(),
            'current' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'has_next' => $paginator->count() && $paginator->currentPage() < $paginator->lastPage()
        ];

        return success($result);
    }
}
