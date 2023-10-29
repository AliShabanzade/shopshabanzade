<?php

namespace App\Services\Media;

use App\Repositories\Media\MediaRepositoryInterface;

class StoreMediaService
{

    public function __construct(private readonly MediaRepositoryInterface $repository)
    {

    }

}
