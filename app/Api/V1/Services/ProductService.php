<?php

namespace App\Api\V1\Services;

use App\Api\V1\Services\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService implements ProductServiceInterface
{
    public function store(Collection $data): void
    {
        $product = new Product();

        $product->name = $data->get("name");
        $product->price = $data->get("price");
        $product->balance = $data->get("balance");

        $product->save();
    }

    public function update(Product $product, Collection $data): void
    {
        $product->name = $data->get("name", $product->name);
        $product->price = $data->get("price", $product->price);
        $product->balance = $data->get("balance", $product->balance);

        $product->save();
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    public function subBalance(Product $product, int $count)
    {
        $product->balance -= $count;

        $product->save();
    }
}