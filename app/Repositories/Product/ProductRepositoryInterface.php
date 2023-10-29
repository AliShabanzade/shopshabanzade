<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;
use MongoDB\Driver\Query;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
//    public function productWithMostComment() ;

//    public function productWithMostView();

//    public function productWithMostLike();

    public function productsWithMorePrice();

}
