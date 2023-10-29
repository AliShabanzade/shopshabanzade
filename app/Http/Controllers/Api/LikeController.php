<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Repositories\Like\LikeRepositoryInterface;
use App\Services\Comment\StoreCommentService;
use App\Services\Like\DeleteLikeService;
use App\Services\Like\IndexLikeService;
use App\Services\Like\ShowLikeService;
use App\Services\Like\StoreLikeService;
use App\Services\Like\UpdateLikeService;
use Illuminate\Http\Request;

class LikeController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(Like::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(LikeRepositoryInterface $repository)
    {
        // this paginate is laravel paginate . in this paginate we don t need to use ->get() to query
        $result = $repository->userLikes(auth()->id())->paginate(15);
//         dd($result);
        return $this->successResponse(LikeResource::collection($result));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LikeRequest $request , StoreLikeService $service)
    {
        $result=  $service->handle($request->validated());
          return $this->successResponse(LikeResource::make($result));
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like , LikeRepositoryInterface $repository)
    {
       $result = $repository->find($like->id);
       return $this->successResponse(LikeResource::make($result));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LikeRequest $request, UpdateLikeService $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteLikeService $service)
    {
        //
    }
}
