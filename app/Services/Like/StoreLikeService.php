<?php

namespace App\Services\Like;

use App\Models\Blog;
use App\Models\Product;
use App\Repositories\Like\LikeRepositoryInterface;

class StoreLikeService
{
    public function __construct(private readonly LikeRepositoryInterface $repository)
    {
    }


    public function handle($payload)
    {
//         $payload['user_id']=auth()->id();
//         $payload['likeable_type']=match ($payload['likeable_type']){
//            'product' =>Product::class,
//            'blog' =>Blog::class,
//         };
         if ($payload['likeable_type']== 'product'){
             $product = Product::find($payload['likeable_id']);
             if ($product){
                return $product->likeOrDislike(auth()->id());

             }
         }elseif ($payload['likeable_type'] == 'blog'){
             $blog = Blog::find($payload['likeable_id']);
             if ($blog){
                return  $blog->likeOrDislike(auth()->user()->id);
             }
         }
//       return $this->repository->store($payload);

    }


}
