<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ViewRequest;
use App\Http\Resources\ViewResource;
use App\Models\View;
use App\Repositories\View\ViewRepositoryInterface;
use App\Services\View\DeleteViewService;
use App\Services\View\IndexViewService;
use App\Services\View\ShowViewService;
use App\Services\View\StoreViewService;
use App\Services\View\UpdateViewService;
use Illuminate\Http\Request;

class ViewController extends BaseApiController
{


    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(View::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(ViewRepositoryInterface $repository)
    {
        $result = $repository->userView(auth()->user()->id);
        return $this->successResponse(ViewResource::collection($result));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ViewRequest $request , StoreViewService $service)
    {
        $result = $service->handle($request->validated());
        return $this->successResponse(ViewResource::make($result));

    }

    /**
     * Display the specified resource.
     */
    public function show(ViewRepositoryInterface $repository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ViewRequest $request, UpdateViewService $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteViewService $service)
    {
        //
    }
}
