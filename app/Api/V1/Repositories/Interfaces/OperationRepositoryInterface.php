<?php

namespace App\Api\V1\Repositories\Interfaces;

use App\Models\Operation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface OperationRepositoryInterface
{
    /**
     * @param int $id
     * @return Operation
     * @throws ModelNotFoundException
     */
    public function byId(int $id): Operation;

    /**
     * @return Collection<Operation>
     */
    public function allFilterAndSortByIdDate(Collection $data): Collection;
}