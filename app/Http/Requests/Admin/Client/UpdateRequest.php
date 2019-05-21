<?php

namespace App\Http\Requests\Admin\Client;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            'dispatcher_id' => 'sometimes|exists:dispatchers,id',
        ];
    }

    /**
     * Custome validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'dispatcher_id.exists' => trans('message.admin.client.error.dispatcher_not_found'),
        ];
    }
}
