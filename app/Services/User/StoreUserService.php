<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\Media\MediaUploaderService;

class StoreUserService
{
    public function __construct(private readonly UserRepositoryInterface $repository,
    private readonly MediaUploaderService $mediaUploder)
    {
    }

    public function handle($payload)
    {
        return \DB::transaction(function () use ($payload){
            $model = $this->repository->store($payload);
            if (request()->hasFile('image')){
                $result = $this->mediaUploder->upload("image");
                $model->medias()->create([
                    'url'=> $result['url']
                ]);
            }
            return $model;
        });

    }

}
