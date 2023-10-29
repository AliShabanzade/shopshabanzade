<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;

class UpdateCommentService
{
    public function __construct(private readonly CommentRepositoryInterface $repository)
    {
    }
        public function update(Comment $comment , $payload)
        {
           return \DB::transaction(function () use ($comment, $payload){
               $payload['user_id'] = auth()->user()->id;

               $result = $this->repository->update($comment , $payload);

               return $result;

            });

        }
}
