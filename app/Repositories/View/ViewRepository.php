<?php

namespace App\Repositories\View;

use App\Models\User;
use App\Models\View;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ViewRepository extends BaseRepository implements ViewRepositoryInterface
{
    public function __construct(View $view)
    {
        parent::__construct($view);
    }

    public function userView ($user_id)
    {
        $user = User::find($user_id);

        return $user->myView()->get();
    }

}
