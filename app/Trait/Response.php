<?php

namespace App\Trait;
use Illuminate\Http\JsonResponse;

trait Response
{
    public function success($data, $message, $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }


    public function failed($data ,$message,  $status = 400): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function message($message, $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $status);
    }
}
