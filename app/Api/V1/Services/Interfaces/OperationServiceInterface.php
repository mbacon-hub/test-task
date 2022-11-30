<?php

namespace App\Api\V1\Services\Interfaces;

use App\Api\V1\Exceptions\NotEnoughProductException;
use App\Api\V1\Exceptions\UserNotEnoughBalanceException;
use App\Models\Operation;
use App\Models\Product;
use App\Models\User;

interface OperationServiceInterface
{
    /**
     * @param Authi|User $user
     * @param Product $product
     * @return void
     * @throws UserNotEnoughBalanceException
     */
    public function checkUserBalanceForProduct(User $user, Product $product): void;

    /**
     * @param Product $product
     * @return void
     * @throws NotEnoughProductException
     */
    public function hasProductForUser(Product $product): void;

    public function store(User $user, Product $product): void;

    public function changeStatus(Operation $operation, int $status): void;
}