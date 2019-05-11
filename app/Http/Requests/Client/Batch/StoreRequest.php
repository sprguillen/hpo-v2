<?php

namespace App\Http\Requests\Client\Batch;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->client();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source_id' => 'required|integer|exists:sources',
            'patient_type_id' => 'required|integer|exists:patient_types',
            'payment_mode' => 'required',

            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
