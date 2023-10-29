<?php

namespace App\Services\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

class StoreCartService
{
    public function __construct(private readonly CartRepositoryInterface $cartRepository)
    {

    }

    public function handle(array $payload)
    {
        /*
         * dar CartRepository product_id & quantity & user_id require shode. user az front product_id va Quantity ra bayad
         * ersal konad ke dakhele request $payload gharar migirad va user_id ra ham az user authenticate jari migirim
         * va in data baraye store ersal mishavad ta dar database zakhire shavad.
         */
        return \DB::transaction(function () use ($payload){

            $payload['user_id'] = auth()->user()->id;

            return $this->cartRepository->store($payload);
        });


    }


}
