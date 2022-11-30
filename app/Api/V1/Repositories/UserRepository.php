<?php

namespace App\Api\V1\Repositories;

use App\Api\V1\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function byEmail(string $email): User
    {
        return User::query()
            ->where("email", "=", $email)
            ->firstOrFail();
    }

    public function byId(int $id): User
    {
        return User::query()
            ->where("id", "=", $id)
            ->firstOrFail();
    }
}