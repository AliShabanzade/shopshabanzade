<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Media\MediaUploaderService;

class UpdateProductService
{
    public function __construct(private readonly ProductRepositoryInterface $repository,
                                private readonly MediaUploaderService $mediaUploader)
    {

    }

    public function handle($eloquent , array $payload):Product
    {
        return \DB::transaction(function () use ($eloquent,$payload){
            $payload['user_id']=auth()->user()->id;
           $this->repository->update($eloquent,$payload);
           if(request()->exists('image')){
               $result = $this->mediaUploader->upload('image');
               //this update is a laravel eloquent function . it's not our update that is in repository
               $eloquent->medias()->update([
                  'url' => $result['url'],
               ]);
           }
           return $eloquent;
        });
    }

}
