<?php

namespace App\Services\View;

use App\Repositories\View\ViewRepositoryInterface;

class DeleteViewService
{
    public function __construct(private readonly ViewRepositoryInterface $repository)
    {
    }
}
