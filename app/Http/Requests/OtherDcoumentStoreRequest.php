<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtherDcoumentStoreRequest extends FormRequest
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
                'type' => 'in:sop,cv,personal_reference,academic_reference|required',
				'letter' => 'mimes:pdf|',
        ];
    }
}
