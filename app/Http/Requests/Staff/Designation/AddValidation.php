<?php

namespace App\Http\Requests\Staff\Designation;

use Illuminate\Foundation\Http\FormRequest;

class AddValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                => 'required | max:25 | unique:staff_designations,title',
        ];

    }

    public function messages()
    {
        return [
            'title.required'            => 'Designation Required',
            'title.unique'              => 'Please Enter Unique Designation.',
        ];
    }
}
