<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct( Blog $blog)
    {
        parent::__construct($blog);
    }

     // dar model blog agar az method query BaseRepository estefade shavad
    // chon query BaseRepository dar BlogRepository override shode dar natije emkanate override shode query dar har
    // ja ke az BlogRepositoryInterface estefade konim dar dastras
    // ast ( BlogRepositoryInterface ba BlogRepository bind shode)

    public function query(array $payload = []): Builder
    {

        return parent::query()->when(!empty($payload['search']) , function (Builder $q) use ($payload){
                $q->where('title' , 'like' , '%' . $payload['search'] . '%');
            });
    }


    public function getLastBlogByDate(Carbon $date): Collection
    {
        return Blog::whereDate('created_at'  , '<' , $date)->get();
    }
}
