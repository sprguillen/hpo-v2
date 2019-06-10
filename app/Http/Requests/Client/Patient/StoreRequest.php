<?php

namespace App\Http\Requests\Client\Patient;

use Illuminate\Validation\Rule;
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
        return auth()->user()->isClient();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'exists:users,id',
            ],
            'client_custom_id' => 'sometimes|unique:patients,client_custom_id',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => [
                'required',
                Rule::in(['male', 'female'])
            ],
            'birth_date' => 'required',
            'blood_type' => [
                'sometimes',
                Rule::in(['O', 'A', 'B', 'AB']),
            ],
        ];
    }
}
