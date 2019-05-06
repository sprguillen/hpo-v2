<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Get auth user information
     *
     * @param  integer $id
     * @return response
     */
    public function index()
    {
        $user = auth()->user();
        return success_data(compact('user'));
    }
}
