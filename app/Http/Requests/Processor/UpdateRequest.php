<?php

namespace App\Http\Requests\Processor;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
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
            'id' => 'required|exists:users',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'username' => 'required|unique:users,username,' . $this->id,
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }
}
