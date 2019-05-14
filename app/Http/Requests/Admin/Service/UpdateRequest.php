<?php

namespace App\Http\Requests\Admin\Service;

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
            'id' => 'required|exists:services',
            'code' => 'required|unique:services,code,' . $this->id,
            'name' => 'required|unique:services,name,' . $this->id,
            'default_cost' => 'required|integer',
        ];
    }
}
