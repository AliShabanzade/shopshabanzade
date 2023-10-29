<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Media\MediaUploaderService;

class UpdateUserService
{
    public function __construct(private readonly UserRepositoryInterface $repository,
                                private readonly MediaUploaderService $mediauploader)
    {
    }

    public function handle($eloquent , array $payload):User
    {
        return \DB::transaction(function() use ($eloquent,$payload){
             $this->repository->update($eloquent , $payload);
             if (request()->hasFile('image')){
                 $result = $this->mediauploader->upload("image");
                 $eloquent->medias()->update([
                    'url' => $result['url'],
                 ]);
             }
             return $eloquent;
        });
    }

}
