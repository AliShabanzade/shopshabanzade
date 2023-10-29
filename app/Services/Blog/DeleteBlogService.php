<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeleteBlogService
{
    public function __construct(private readonly BlogRepositoryInterface $repository)
    {


    }


    public function handle($eloquent)
    {

        return DB::transaction(function () use ($eloquent) {
           $this->repository->delete($eloquent);
            return true;

        });


    }

}
