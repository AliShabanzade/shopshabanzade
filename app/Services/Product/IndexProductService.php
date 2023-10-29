<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;

class IndexProductService
{
     public function __construct(private readonly ProductRepositoryInterface $repository)
     {
     }
}
