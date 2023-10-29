<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;


class ShowProductService
{
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {

    }


}
