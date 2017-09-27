<?php

namespace App\Http\Requests\Colloquium;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'max:80',
            'training_id' => 'exists:trainings,id',
            'speaker' => 'max:80',
            'email' => 'nullable|max:255|email',
            'location' => 'max:80',
            'description' => 'max:140',
            'status' => 'in:1,2,3,4',
            'language' => 'max:80',
        ];
    }
}
