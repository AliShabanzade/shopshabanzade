<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;

use App\Services\Media\MediaUploaderService;
use Illuminate\Support\Facades\DB;

class StoreBlogService
{
    public function __construct(private readonly BlogRepositoryInterface $repository,
                                private readonly MediaUploaderService $mediaUploader)
    {
    }

    public function handle(array $payload)
    {
        return DB::transaction(function () use($payload){
            // current user (auth()->id()) wants to create a user(user jari admin ast)
            $payload['user_id'] = auth()->id();
            $model = $this->repository->store($payload);
            if (request()->hasFile('image')){
                // see lesson 27 Repository In service
                $result = $this->mediaUploader->upload("images");
                $model->medias()->create([
                    'url'=> $result['url'],
                ]);
            }
            return $model;
        });
    }



}
