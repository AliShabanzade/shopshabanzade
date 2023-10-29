<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Services\Comment\DeleteCommentService;
use App\Services\Comment\IndexCommentService;
use App\Services\Comment\ShowCommentService;
use App\Services\Comment\StoreCommentService;
use App\Services\Comment\UpdateCommentService;
use Illuminate\Http\Request;

class CommentController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(Comment::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ,CommentRepositoryInterface $repository)
    {
        $result = $repository->paginate($request->input('limit' , 5) , $request->all());
        return $this->successResponse(CommentResource::collection($result));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request , StoreCommentService $service)
    {


      $data= $service->handle($request->validated());



      return $this->successResponse(CommentResource::make($data) , 'comment has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment , CommentRepositoryInterface $repository)
    {
         $result =  $repository->findByUuid($comment->uuid );
         return $this->successResponse(CommentResource::make($result));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request , Comment $comment, UpdateCommentService $service)
    {
        $result = $service->update($comment ,$request->validated());
        return $this->successResponse(CommentResource::make($result) , 'this comment has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment,DeleteCommentService $service)
    {
       $service->delete($comment);
       return $this->successResponse(['' , 'this Comment has been successfully deleted'] , 200);

    }


}
