<?php

namespace App\Services\Comment;

use App\Models\Blog;
use App\Models\Product;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Traits\HasComment;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class StoreCommentService
{
    use HasComment;
    public function __construct(private readonly CommentRepositoryInterface $repository)
    {
    }


    public function handle(array $payload)
    {

        return DB::transaction(function () use($payload){


            // current user (auth()->id()) wants to create a user(user jari admin ast)
            $payload['user_id'] = auth()->user()->id;


            if($payload['commentable_type']==='product'){
//
                $payload['commentable_type']=Product::class;


            }
            elseif($payload['commentable_type']==='blog'){
              $payload['commentable_type']=Blog::class;
            }


            $model = $this->repository->store($payload);

            return $model;
        });
    }

}
