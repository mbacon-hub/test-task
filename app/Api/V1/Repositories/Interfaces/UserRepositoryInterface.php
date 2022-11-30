<?php

namespace App\Api\V1\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     * @return User
     * @throws ModelNotFoundException
     */
    public function byEmail(string $email): User;

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function byId(int $id): User;
}