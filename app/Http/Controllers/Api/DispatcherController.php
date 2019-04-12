<?php

namespace App\Http\Controllers\API;

use API;
use Validator;
use App\Models\Dispatcher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DispatcherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function add(Request $request)
    {
        $dispatcher = [
            'code' => $request->code,
            'name' => $request->name
        ];

        $rules = [
            'code' => 'required|unique:sources',
            'name' => 'required'
        ];

        $validator = Validator::make($dispatcher, $rules);

        if ($validator->passes()) {
            Dispatcher::create([
                'code' => $request->code,
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Successfully created source!'
            ], 201);
        } else {
            $errors = $validator->errors();
            foreach($errors->all() as $message) {
                if ($message) {
                    return response()->json([
                        'error' => $message
                    ], 422);
                }
            }
        }
    }
}
