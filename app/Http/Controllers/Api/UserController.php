<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Blog;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\DeleteUserService;
use App\Services\User\IndexUserService;
use App\Services\User\ShowUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{


    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(User::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , UserRepositoryInterface $repository)
    {
         $user = $repository->paginate($request->input('limit' , '5') , $request->all());
         return $this->successResponse(UserResource::collection($user));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request , StoreUserService $service)
    {
        $user= $service->handle($request->validated());
        return $this->successResponse(UserResource::make($user) , 'the user has been created successfully' );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user ,UserRepositoryInterface $repository)
    {

        $result = $repository->findByUuid($user->uuid);
        return $this->successResponse(UserResource::make($result));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UserRequest $request, UpdateUserService $service)
    {
        $result = $service->handle($user , $request->validated());
        return $this->successResponse(UserResource::make($result) , 'user has been updated successfully' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user , UserRepositoryInterface $repository)
    {
        $repository->delete($user);
        return $this->successResponse('' , 'user has been deleted successfully');
    }
}
