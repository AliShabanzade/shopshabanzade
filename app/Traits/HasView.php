<?php

namespace App\Traits;

use App\Models\View;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasView
{
    public function views():MorphMany
    {
        return  $this->morphMany(View::class , 'viewable');
    }

    public function makeView($user_id)
    {
        $view = $this->views()->where('user_id' , $user_id)->first();
        if ($view){
            //is_view is a new key for showing in viewResource
            $view->is_view = true;
            return $view;

        }else{
            $view = $this->views()->create(['user_id' => $user_id]);

            return $view;
        }

    }

}
