<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
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
                'user_id' => '',
				'course_type' => 'in:under_graduation,post_graduation|',
				'subject_id' => '',
				'university_id' => '',
				'surname' => '',
				'given_name' => '',
				'email' => '',
				'date_of_birth' => '',
				'address' => '',
				'passport_no' => '',
				'expiry_date' => '',
				'ielts_score' => '',
				'passport_file' => 'mimes:pdf|',
        ];
    }
}
