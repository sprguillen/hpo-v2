<?php

namespace App\Http\Requests\Client\Patient;

use App\Models\Patient;
use Illuminate\Validation\Rule;
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
            'id' => 'required|exists:patients',
            'client_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    // Check if user is the client on this `patient` data
                    $patient = Patient::find($this->id);
                    if ($patient->client_id != $value) {
                        $fail(trans('message.client.patient.error.patient_not_owned'));
                    }
                },
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
