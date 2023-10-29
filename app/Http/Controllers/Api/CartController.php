<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartShowResource;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Services\Cart\StoreCartService;
use Illuminate\Http\Request;

class CartController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , CartRepositoryInterface $repository)
    {
        // all cart item of current user
        $cartItems = $repository->getUserCard(auth()->id());

       return $this->successResponse(CartResource::collection($cartItems));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request , StoreCartService $service)
    {

        // add new cart Item to cart
        $addCartItem = $service->handle($request->validated());

        return $this->successResponse(CartResource::make($addCartItem) , 'this product has been added successfully to basket');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart , CartRepositoryInterface $repository)
    {
        // when user click on cart item show complete information of this item (product)
        $cartItem= $repository->find($cart->id);
        return $this->successResponse(CartShowResource::make($cartItem));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
