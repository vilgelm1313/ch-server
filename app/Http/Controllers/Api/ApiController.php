<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function success(mixed $data = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function fail(mixed $data = null, int $code = -1): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'code' => $code,
        ]);
    }
}
