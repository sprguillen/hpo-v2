<?php

namespace App\Http\Controllers;

use API;
use Validator;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function add(Request $request)
    {
        $source = [
            'name' => $request->name
        ];

        $rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($source, $rules);

        if ($validator->passes()) {
            $source = Source::create([
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
