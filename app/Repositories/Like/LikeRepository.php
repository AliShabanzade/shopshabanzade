<?php

namespace App\Repositories\Like;

use App\Models\Like;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    public function __construct(Like $like)
    {
        parent::__construct($like);
    }

    public function userLikes($user_id)
    {
         $user = User::find($user_id);
        return  $user->myLikes();

    }

}
