<?php

namespace App\Http\Requests\Admin\Client;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateDispatcherModeRequest extends BaseRequest
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
            'dispatcher_id' => 'required|exists:dispatchers,id',
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
