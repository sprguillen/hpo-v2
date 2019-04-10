<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index() {
        return view('main.index');
    }

    public function authIndex() {
        return view('auth.index');
    }
}
