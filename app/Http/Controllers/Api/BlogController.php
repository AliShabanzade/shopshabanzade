<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\Blog\DeleteBlogService;
use App\Services\Blog\IndexBlogService;
use App\Services\Blog\ShowBlogService;
use App\Services\Blog\StoreBlogService;
use App\Services\Blog\UpdateBlogService;
use Illuminate\Http\Request;

class BlogController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(Blog::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , BlogRepositoryInterface $repository)
    {
        // $request->all = Blog::all()
//        dd($request);
        // the key send from postman => params = $request->input , header = $request->header
        $blogs = $repository->paginate($request->input('limit' , 5) , $request->all());

        return $this->successResponse(BlogResource::collection($blogs));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request , StoreBlogService $service)
    {
        $data = $request->validated();
        $blog = $service->handle($data);
        return $this->successResponse(BlogResource::make($blog->load(['user'])) ,
            'User created successfully' , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog ,  BlogRepositoryInterface $repository)
    {

        $result = $repository->findByUuid($blog->uuid , ['title' , 'body']);
        return $this->successResponse(BlogResource::make($result));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog, UpdateBlogService $service)
    {

        $data=$service->handle($blog,$request->validated());
        return $this->successResponse( [BlogResource::make($data) , 'the blog has been successfully updated'] , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, BlogRepositoryInterface $repository)
    {
        $repository->delete($blog);
        return $this->successResponse(['' , 'the blog has been successfully deleted'] , 200);

    }


    public function blogWithMostView(BlogRepositoryInterface $repository)
    {
        $result = $repository->mostViews();
        return $this->successResponse(BlogResource::collection($result));
    }

    public function mostCommentBlog(BlogRepositoryInterface $repository)
    {
        $result = $repository->mostComment();
        return $this->successResponse(BlogResource::collection($result));
    }

    public function mostLikeBlog(BlogRepositoryInterface $repository)
    {
        $result = $repository->mostLike();
        return $this->successResponse(BlogResource::collection($result));

    }


}
