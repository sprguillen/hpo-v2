<?php

namespace App\Http\Requests\Admin\System\PatientType;

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
            'id' => 'required|exists:patient_types',
            'code' => 'required|unique:patient_types,code,' . $this->id,
            'name' => 'required|unique:patient_types,name,' . $this->id,
        ];
    }
}
