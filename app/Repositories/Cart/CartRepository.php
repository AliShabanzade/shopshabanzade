<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CartRepository extends BaseRepository implements CartRepositoryInterface , \Countable
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    public function count(): int
    {

    }

    public function getUserCard($user_id)
    {
        return parent::query()->where('user_id' , $user_id)->get();
    }


}
