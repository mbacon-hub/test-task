<?php

namespace App\Api\V1\Services\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface AuthServiceInterface
{
    /**
     * @param Collection $data
     * @return User
     * @throw BusinessException
     */
    public function checkCredentials(Collection $data): User;

    public function getUserToken(User $user): string;
}