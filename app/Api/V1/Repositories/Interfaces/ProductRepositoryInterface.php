<?php

namespace App\Api\V1\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * @param Collection $data
     * @return Collection<Product>
     */
    public function allFilterByIdNamePriceSortByPrice(Collection $data): Collection;

    /**
     * @param int $id
     * @return Product
     * @throws ModelNotFoundException
     */
    public function byId(int $id): Product;
}