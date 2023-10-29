<?php

namespace App\Services\Like;

use App\Repositories\Like\LikeRepositoryInterface;

class DeleteLikeService
{
    public function __construct(private readonly LikeRepositoryInterface $repository)
    {
    }

}
