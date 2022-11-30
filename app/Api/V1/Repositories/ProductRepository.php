<?php

namespace App\Api\V1\Repositories;

use App\Api\V1\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @param Collection $data
     * @return Collection<Product>
     */
    public function allFilterByIdNamePriceSortByPrice(Collection $data): Collection
    {
        $models = Product::hasBalance();

        /** Filter by id */
        $models->when($data->get("id", null), function (Builder $q) use (&$data) {
            $q->where("id", "=", $data->get("id"));
        });

        /** Filter by name */
        $models->when($data->get("name", null), function (Builder $q) use (&$data) {
            $q->where("name", "=", $data->get("name"));
        });

        /** Filter by name */
        $models->when($data->get("price", null), function (Builder $q) use (&$data) {
            $q->where("price", "=", $data->get("price"));
        });

        /** Sort by price */
        $models->orderBy("price", $data->get("sortDir", "desc"));

        return $models->get();
    }

    public function byId(int $id): Product
    {
        return Product::query()
            ->where("id", "=", $id)
            ->firstOrFail();
    }
}