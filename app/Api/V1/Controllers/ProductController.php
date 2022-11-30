<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Repositories\Interfaces\ProductRepositoryInterface;
use App\Api\V1\Repositories\Interfaces\UserRepositoryInterface;
use App\Api\V1\Requests\ProductBuyRequest;
use App\Api\V1\Requests\ProductIndexRequest;
use App\Api\V1\Requests\ProductUpdateRequest;
use App\Api\V1\Resources\ProductResource;
use App\Api\V1\Services\Interfaces\OperationServiceInterface;
use App\Api\V1\Services\Interfaces\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(
        ProductIndexRequest        $request,
        ProductRepositoryInterface $productRepository
    ): JsonResponse
    {
        $data = collect($request->validated());
        $products = $productRepository->allFilterByIdNamePriceSortByPrice(data: $data);

        return successJsonResponse(ProductResource::collection($products));
    }

    public function store(
        ProductUpdateRequest    $request,
        ProductServiceInterface $productStoreService
    ): JsonResponse
    {
        $data = collect($request->validated());

        $productStoreService->store(data: $data);

        return successJsonResponse();
    }

    public function update(
        ProductUpdateRequest       $request,
        int                        $id,
        ProductRepositoryInterface $productRepository,
        ProductServiceInterface    $productStoreService
    ): JsonResponse
    {
        $data = collect($request->validated());
        $product = $productRepository->byId(id: $id);

        $productStoreService->update(product: $product, data: $data);

        return successJsonResponse();
    }

    public function delete(
        int                        $id,
        ProductRepositoryInterface $productRepository,
        ProductServiceInterface    $productStoreService
    ): JsonResponse
    {
        $product = $productRepository->byId(id: $id);

        $productStoreService->delete(product: $product);

        return successJsonResponse();
    }

    public function buy(
        ProductBuyRequest          $request,
        ProductRepositoryInterface $productRepository,
        OperationServiceInterface  $operationStoreService
    ): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $product = $productRepository->byId(id: $request->get("product_id"));

        $operationStoreService->checkUserBalanceForProduct(user: $user, product: $product);

        $operationStoreService->hasProductForUser(product: $product);

        $operationStoreService->store(user: $user, product: $product);

        return successJsonResponse();
    }
}
