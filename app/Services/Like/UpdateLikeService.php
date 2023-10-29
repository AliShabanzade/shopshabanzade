<?php

namespace App\Services\Like;

use App\Repositories\Like\LikeRepositoryInterface;

class UpdateLikeService
{
    public function __construct(private readonly LikeRepositoryInterface $repository)
    {
    }
}
