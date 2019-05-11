<?php

namespace App\Http\Requests\Admin\Client;

use App\Http\Requests\BaseRequest;

class UpdatePaymentModeRequest extends BaseRequest
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
            'payment_mode' => 'required|between:0,1',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment_mode.between' => trans('message.admin.client.manage.error.invalid_payment_mode'),
        ];
    }
}
