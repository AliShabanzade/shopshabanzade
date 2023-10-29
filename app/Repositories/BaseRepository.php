<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(public Model $model)
    {
    }


    // $payload in this function is just if the child wants to pass som data to query and it can be empty
    public function query(array $payload = []): Builder
    {
        // $payload ke dar parameter function query gerefte shode baraye  in ast ke agar in function dar class haye
        // farzand override shod va dar hengame override shodan niyaz be $payload dasht khata nagirad va betavan az
        //parametere voroodi payload estefade kard .masalan dar blog repository search neveshte shode ke ham az
        // query parent estefade karde va ham dar anja az payload estefade karde
        // model->query{Product::query() } . query() function is a instance of laravel Builder that we can make
        //chainable queries like where - when...
        return $this->model->query();
    }

    public function paginate(int $limit = 10, array $payload = [])
    {
        //the paginate in following line is laravel function
        return $this->query($payload)->paginate($limit);
    }

    public function get(array $payload = [])
    {
        return $this->query($payload)->get();
    }

    public function store(array $payload): Model
    {
        return $this->model->create($payload);
    }

    public function update($eloquent, array $payload): Model
    {
        $eloquent->update($payload);
        return $eloquent;
    }

    public function delete($eloquent): bool
    {
        return $eloquent->delete();
    }

    public function find(int $id, array $payload = ['*']): Model
    {
        return $this->model->select($payload)->find($id);
    }

    public function findByUuid(string $uuid, array $payload = ['*']): Model
    {
        return $this->model->select($payload)->where('uuid',$uuid)->first();
    }


    public function  mostViews()
    {
        //we can use mostViews directly in controller because of constructors and repository injection
        //at first we implement this function in each model but because of code repeat we moved this function to
        //BaseRepositoryInterface to avoid of repeat code
        return $this->query()->withCount('views')->orderByDesc('views_count')->take(5)->get();


    }


    public function mostComment()
    {
        //we can use mostComment directly in controller because of constructors and repository injection
        //at first we implement this function in each model but because of code repeat we moved this function to
        //BaseRepositoryInterface to avoid the repeat code
        return $this->query()->withCount('comments')->orderByDesc('comments_count')->take(5)->get();
    }


    public function mostLike()
    {
        //we can use mostLike directly in controller because of constructors and repository injection
        //at first we implement this function in each model but because of code repeat we moved this function to
        //BaseRepositoryInterface to avoid the repeat code
        return $this->query()->withCount('likes')->orderByDesc('likes_count')->take(5)->get();
    }
}

