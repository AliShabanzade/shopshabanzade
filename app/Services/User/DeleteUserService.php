<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;


class DeleteUserService
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

}
