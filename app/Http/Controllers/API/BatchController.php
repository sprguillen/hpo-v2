<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAll(Request $request)
    {
        $status = $request->status;
        $page = (int)$request->page;
        $size = (int)$request->count;

        
    }
}
