<?php

namespace App\Http\Requests\Client\Patient;

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
            'id' => 'required|exists:client_staffs',
            'client_id' => 'required|exists:users,id',
            'client_custom_id' => 'sometimes|unique:patients,client_custom_id' . $this->id,
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => [
                'required',
                Rule::in(['male', 'female'])
            ],
            'birth_date' => 'required',
        ];
    }
}
