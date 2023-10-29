<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Models\User;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\Media\MediaUploaderService;


class UpdateBlogService
{
    public function __construct(private readonly BlogRepositoryInterface $repository,
                                private readonly MediaUploaderService $mediaUploader){
    }

    public function handle($eloquent , array $payload): Blog
    {
        return \DB::transaction(function () use ($eloquent, $payload){
            $this->repository->update($eloquent, $payload);
            //image = the key that user send
            if (request()->hasFile('image')){
                // images = the key in upload function that save image of user image that uploaded
                $result = $this->mediaUploader->upload("images");
                //before updating , we can delete old image and then ...
                // this update is for laravel eloquent Model . it is not update in our repository
                $eloquent->medias()->update([
                    'url' => $result['url'],
                ]);
            }

            return $eloquent;

        });

    }

}
