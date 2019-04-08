<?php

namespace App\Http\Controllers;

use API;
use Validator;
use App\Models\PatientType;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addType(Request $request)
    {
        $type = [
            'code' => $request->code,
            'name' => $request->name
        ];

        $rules = [
            'code' => 'required|unique:patient_types',
            'name' => 'required'
        ];

        $validator = Validator::make($type, $rules);

        if ($validator->passes()) {
            PatientType::create([
                'code' => $request->code,
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Successfully created patient type!'
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
