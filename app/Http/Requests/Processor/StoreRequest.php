<?php

namespace App\Http\Requests\Processor;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->admin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
