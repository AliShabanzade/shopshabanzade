<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogRepositoryInterface;

use App\Services\Media\MediaUploaderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RemoveOldBlogService
{
    public function __construct(private readonly BlogRepositoryInterface $repository,
    private MediaUploaderService $service)
    {
    }


    public function handle()
    {

        return DB::transaction(function (){
            $items =$this->repository->getLastBlogByDate(Carbon::now()->subYear());
            foreach ($items as $item){
                $item->medias()->delete();
                $item->delete();
            }
            return true;
        });
    }

}
