<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Media\MediaUploaderService;
use Illuminate\Support\Facades\DB;

class StoreProductService
{
     public function __construct(private readonly ProductRepositoryInterface $repository,
     private readonly MediaUploaderService $mediaUploaderService)
     {

     }

    public function handle(array $payload)
    {
        return DB::transaction(function () use($payload){
            // current user (auth()->id()) wants to create a user(user jari admin ast)
            $payload['user_id'] = auth()->id();
            $model = $this->repository->store($payload);
            if (request()->hasFile('image')){
                $result = $this->mediaUploaderService->upload("images");
                $model->medias()->create([
                    'url'=> $result['url'],
                ]);
            }
            return $model;
        });
    }
}
