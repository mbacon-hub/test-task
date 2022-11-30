<?php

namespace App\Api\V1\Services\Interfaces;

use App\Models\User;

interface UserBalanceServiceInterface
{
    public function add(User $user, float $sum): void;

    public function sub(User $user, float $sum): void;
}