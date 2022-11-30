<?php

namespace App\Api\V1\Services;

use App\Api\V1\Exceptions\NotEnoughProductException;
use App\Api\V1\Exceptions\UserNotEnoughBalanceException;
use App\Api\V1\Jobs\ProcessOperation;
use App\Api\V1\Services\Interfaces\OperationServiceInterface;
use App\Models\Operation;
use App\Models\Product;
use App\Models\User;

class OperationService implements OperationServiceInterface
{

    public function checkUserBalanceForProduct(User $user, Product $product): void
    {
        if ((float)$user->balance < (float)$product->price) {
            throw new UserNotEnoughBalanceException("You do not have enough balance for this product");
        }
    }

    public function hasProductForUser(Product $product): void
    {
        if ((int)$product->balance <= 0) {
            throw new NotEnoughProductException("You are trying to buy a product that is out of stock");
        }
    }

    public function store(User $user, Product $product): void
    {
        $operation = new Operation();

        $operation->product_id = $product->id;
        $operation->user_id = $user->id;
        $operation->price = $product->price;

        $operation->save();

        dispatch(new ProcessOperation(operationId: $operation->id));
    }

    public function changeStatus(Operation $operation, int $status): void
    {
        $operation->status = $status;

        $operation->save();
    }

}