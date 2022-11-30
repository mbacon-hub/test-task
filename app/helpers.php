<?php

function successJsonResponse(array|ArrayAccess $data = []): \Illuminate\Http\JsonResponse
{
    return response()->json([
        "status" => 200,
        "message" => "success",
        "data" => $data,
    ], 200);
}