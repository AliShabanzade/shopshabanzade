<?php

namespace App\Services\View;

use App\Repositories\View\ViewRepositoryInterface;

class UpdateViewService
{
    public function __construct(private readonly ViewRepositoryInterface $repository)
    {
    }

}
