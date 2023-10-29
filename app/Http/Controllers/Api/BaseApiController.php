<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function successResponse( $data=null,$message="",$status=200)
    {
        return response()->json(compact('data','message'),$status);
    }

    public function errorResponse($data=null ,$message="" ,$status=400)
    {
        return response()->json(compact('data','message'),$status);
    }
}
