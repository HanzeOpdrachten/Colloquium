<?php

namespace App\Http\Requests\Colloquium;

use App\Colloquium;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:80',
            'training_id' => 'required|exists:trainings,id',
            'start_date' => 'required',
            'end_date' => 'required',
            'speaker' => 'required|max:80',
            'location' => 'required|max:80',
            'description' => 'required|max:140',
            'status' => 'in:1,2,3,4',
            'language' => 'required|max:80',
        ];

        if (Auth::guest()) {
            $rules['email'] = 'required|max:255|email';
        }

        return $rules;
    }
}
