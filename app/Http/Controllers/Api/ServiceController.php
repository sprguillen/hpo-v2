<?php

namespace App\Http\Controllers\API;

use API;
use Validator;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function add(Request $request)
    {
        $service = [
            'code' => $request->code,
            'name' => $request->name,
            'default_cost' => $request->defaultCost
        ];

        $rules = [
            'code' => 'required|unique:services',
            'name' => 'required'
        ];

        $validator = Validator::make($service, $rules);

        if ($validator->passes()) {
            Service::create([
                'code' => $request->code,
                'name' => $request->name,
                'default_cost' => $request->default_cost
            ]);

            return response()->json([
                'message' => 'Successfully created service!'
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
