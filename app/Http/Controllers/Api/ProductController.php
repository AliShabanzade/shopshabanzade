<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Services\Product\DeleteProductService;
use App\Services\Product\IndexProductService;
use App\Services\Product\ShowProductService;
use App\Services\Product\StoreProductService;
use App\Services\Product\UpdateProductService;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(Product::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductRepository $repository)
    {

        $data = $repository->paginate($request->input('limit' , 3) , $request->all());
        return $this->successResponse(ProductResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request , StoreProductService $service)
    {
//        $data = $request->validated();

        $product = $service->handle($request->validated());
        return $this->successResponse(BlogResource::make($product) ,
            'User created successfully' , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRepositoryInterface $repository, Product $product)
    {
//        dd($product);
      $data= $repository->find($product->id);

//         dd($product);
//        $data= $repository->find($product->id);
        return $this->successResponse(ProductResource::make($data->load(['user' , 'likes' , 'views' , 'medias'])));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, UpdateProductService $service)
    {
          $data= $service->handle($product , $request->validated());
          return $this->successResponse(ProductResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product ,DeleteProductService $service)
    {
        $service->handle($product);
        return $this->successResponse(['' ,'the product has been successfully deleted'] , 200);

    }


    public function mostCommentedProduct(ProductRepositoryInterface $repository)
    {

       $result = $repository->mostComment();

        return $this->successResponse(ProductResource::collection($result) );

    }


    public function mostLikedProduct(ProductRepositoryInterface $repository)
    {

        $result = $repository->mostLike();

        return $this->successResponse(ProductResource::collection($result) );

    }


    public function mostViewedProduct(ProductRepositoryInterface $repository)
    {
       $result =  $repository->mostViews();
       return $this->successResponse(ProductResource::collection($result));
    }

    public function morePriceProducts(ProductRepositoryInterface $repository)
    {
        $result = $repository->productsWithMorePrice();
        return $this->successResponse(ProductResource::collection($result));
    }


    public function storage(StorageRepositoryInterface $repository)
    {

        $sessionStorage = resolve(StorageRepositoryInterface::class);
//        $sessionStorage->set('item' , 5);
        $repository->set('product' ,5);
        $repository->set('blog' ,1);
        $repository->set('item' ,7);
        dd($repository->all());
//        dd($repository->get('product'));
//        dd($repository->all());
//          dd($repository->exists('product'));
//        $repository->unset('item');
//        $repository->unset('blog');
//        $repository->unset('product');
//        $repository->clear();

//        dump($sessionStorage->count());


    }
}
