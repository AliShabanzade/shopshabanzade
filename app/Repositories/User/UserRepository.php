<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function query(array $payload = []): Builder
    {
        return parent::query()->when(!empty($payload['search']) , function (Builder $q) use ($payload){
            $q->where('name' , 'like' , '%' . $payload['search'] . '%')
                ->orWhere('family', 'like', '%' . $payload['search'] . '%')
                  ->orWhere('email' , 'like' , '%' . $payload['search'] . '%');
        });
    }


}
