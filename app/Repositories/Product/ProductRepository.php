<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use function Laravel\Prompts\select;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }


//    public function productWithMostComment()
//    {
//
//        return Product::withCount('comments')->orderByDesc('comments_count')
//            ->take(4)
//            ->get();
//
//    }


//    public function productWithMostLike()
//    {
//
//
//        return Product::withCount('likes')->orderByDesc('likes_count')
//            ->take(4)
//            ->get();
//
//    }


//    public function  productWithMostView()
//    {
//        return  Product::withCount('views')->orderByDesc('views_count')
//            ->take(4)
//            ->get();
//
//
//    }


    public function productsWithMorePrice()
    {
        return Product::orderByDesc('price')->take(10)->get();
    }
}
