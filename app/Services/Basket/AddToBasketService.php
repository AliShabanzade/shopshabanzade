<?php

namespace App\Services\Basket;

use App\Models\Product;
use App\Repositories\Storage\StorageRepositoryInterface;

class AddToBasketService
{
    public function __construct(private StorageRepositoryInterface $repository)
    {
    }

    public function add(Product $product , int $quantity)
    {
        return $this->repository->set($product->id , ['quantity' => $quantity]);
    }

}
