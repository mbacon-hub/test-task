<?php

namespace App\Api\V1\Services;

use App\Api\V1\Exceptions\BusinessException;
use App\Api\V1\Services\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{

    public function checkCredentials(Collection $data): User
    {
        $user = User::query()
            ->where("email", "=", $data->get("email"))
            ->firstOr(function () {
                throw new BusinessException("Wrong email or password", 401);
            });

        if (!Hash::check($data->get("password"), $user->password)) {
            throw new BusinessException("Wrong email or password", 401);
        }

        return $user;
    }

    public function getUserToken(User $user): string
    {
        return $user->createToken("auth")->accessToken;
    }
}