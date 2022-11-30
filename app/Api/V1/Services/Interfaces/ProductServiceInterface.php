<?php

namespace App\Api\V1\Services\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductServiceInterface
{
    public function delete(Product $product): void;

    public function store(Collection $data): void;

    public function update(Product $product, Collection $data): void;

    public function subBalance(Product $product, int $count);
}