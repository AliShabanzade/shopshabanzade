<?php

namespace App\Repositories\View;

use App\Repositories\BaseRepositoryInterface;

interface ViewRepositoryInterface extends BaseRepositoryInterface
{
    public function userView($user_id);

}
