<?php

namespace App\Repositories\Blog;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    public function getLastBlogByDate(Carbon $date): Collection ;



}
