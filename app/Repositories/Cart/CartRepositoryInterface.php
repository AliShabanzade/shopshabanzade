<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Storage\StorageRepositoryInterface;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserCard($user_id);


}
