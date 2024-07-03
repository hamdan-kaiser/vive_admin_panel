<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicProfileStore extends FormRequest
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
            'date_of_birth' => 'required',
            'ielts_score' => 'required',
            'address' => 'required'
        ];
    }
}
