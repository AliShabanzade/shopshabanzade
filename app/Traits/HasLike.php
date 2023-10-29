<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLike
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class , 'likeable');
    }

    public function likeOrDislike($user_id)
    {

        $like =  $this->likes()->where('user_id' , $user_id)->first();
        if($like){
            $like->delete();
            //is_like is a new key for showing in likeResource
            $like->is_like=false;
            return $like;
        }else{
            $like= $this->likes()->create(['user_id' => $user_id]);
            $like->is_like=true;
            return $like;
        }

    }

}
