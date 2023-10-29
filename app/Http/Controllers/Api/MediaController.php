<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Models\Media;
use App\Repositories\Media\MediaRepositoryInterface;
use App\Services\Media\DeleteMediaService;
use App\Services\Media\IndexMediaService;
use App\Services\Media\ShowMediaService;
use App\Services\Media\StoreMediaService;
use App\Services\Media\UpdateMediaService;
use Illuminate\Http\Request;

class MediaController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
            $this->authorizeResource(Media::class);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(MediaRepositoryInterface $repository)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaRequest $request  , StoreMediaService $service)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaRepositoryInterface $repository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MediaRequest $request, UpdateMediaService $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteMediaService $service)
    {
        //
    }
}
