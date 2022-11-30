<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\LoginRequest;
use App\Api\V1\Services\Interfaces\AuthServiceInterface;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        AuthServiceInterface $authService,
    ): \Illuminate\Http\JsonResponse
    {
        $data = collect($request->validated());
        $user = $authService->checkCredentials(data: $data);

        return successJsonResponse([
            "type" => "bearer",
            "token" => $authService->getUserToken(user: $user)
        ]);
    }
}