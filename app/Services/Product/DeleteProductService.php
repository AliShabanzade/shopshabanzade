<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;


class DeleteProductService
{
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {

    }


    public function handle($eloquent):bool
    {
        return $this->repository->delete($eloquent);
    }

}
