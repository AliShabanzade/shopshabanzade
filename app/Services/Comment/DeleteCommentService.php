<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;

class DeleteCommentService
{
    public function __construct(private readonly CommentRepositoryInterface $repository)
    {
    }

    public function delete(Comment $comment)
    {


        return  $this->repository->delete($comment);
   }

}
