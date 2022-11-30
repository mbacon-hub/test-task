<?php

namespace App\Api\V1\Repositories;

use App\Api\V1\Repositories\Interfaces\OperationRepositoryInterface;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class OperationRepository implements OperationRepositoryInterface
{

    public function byId(int $id): Operation
    {
        return Operation::query()
            ->where("id", "=", $id)
            ->firstOrFail();
    }

    public function allFilterAndSortByIdDate(Collection $data): Collection
    {
        $models = Operation::query();

        /** Filter by user */
        $models->when($data->get("user_id", null), function (Builder $q) use(&$data) {
            $q->where("user_id", "=", $data->get("user_id"));
        });

        /** Filter by date */
        $models->when($data->get("date", null), function (Builder $q) use(&$data) {
            $q->where(function (Builder $q) use(&$data) {
                $startOfDay = Carbon::createFromFormat("Y-m-d", $data->get("date"))->startOfDay();
                $endOfDay = Carbon::createFromFormat("Y-m-d", $data->get("date"))->endOfDay();

                $q->where("created_at", ">=", $startOfDay);
                $q->where("created_at", "<=", $endOfDay);
            });
        });

        /** Sort by (id, created_at) in asc or desc order */
        $models->orderBy($data->get("sortBy", "id"), $data->get("sortDir", "desc"));

        return $models->get();
    }
}