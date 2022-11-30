<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Repositories\Interfaces\OperationRepositoryInterface;
use App\Api\V1\Requests\OperationIndexRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class OperationController extends Controller
{
    public function index(
        OperationIndexRequest        $request,
        OperationRepositoryInterface $operationRepository
    ): JsonResponse
    {
        $data = collect($request->validated());
        $operations = $operationRepository->allFilterAndSortByIdDate(data: $data);

        return successJsonResponse($operations);
    }
}