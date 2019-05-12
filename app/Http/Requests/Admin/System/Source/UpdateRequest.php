<?php

namespace App\Http\Requests\Admin\System\Source;

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
            'id' => 'required|exists:sources',
            'code' => 'required|unique:sources,code,' . $this->id,
            'name' => 'required|unique:sources,name,' . $this->id,
        ];
    }
}
