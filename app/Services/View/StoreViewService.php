<?php

namespace App\Services\View;

use App\Models\Blog;
use App\Models\Product;
use App\Repositories\View\ViewRepositoryInterface;

class StoreViewService
{
    public function __construct(private readonly ViewRepositoryInterface $repository)
    {
    }


    public function handle($payload)
    {
//        $payload['user_id']  = auth()->user()->id;
//
//        $payload['likeable_type']  = match ($payload['likeable_type']){
//          'product' => Product::class,
//          'blog'=> Blog::class,
//        };

        if ($payload['viewable_type'] == 'product') {
            $product = Product::find($payload['viewable_id']);
            if ($product) {
                return $product->makeView(auth()->user()->id);
            }
        } elseif ($payload['viewable_type'] == 'blog') {

            $blog = Blog::find($payload['viewable_id']);
            if ($blog){
                return $blog->makeView(auth()->id());
            }
        }


    }

//        return $this->repository->store($payload);

}


