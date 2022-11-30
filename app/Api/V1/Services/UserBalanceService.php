<?php

namespace App\Api\V1\Services;

use App\Api\V1\Services\Interfaces\UserBalanceServiceInterface;
use App\Models\User;

class UserBalanceService implements UserBalanceServiceInterface
{

    public function add(User $user, float $sum): void
    {
        $user->balance += $sum;

        $user->save();
    }

    public function sub(User $user, float $sum): void
    {
        $this->add(user: $user, sum: $sum * -1);
    }
}