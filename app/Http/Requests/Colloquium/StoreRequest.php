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
        return [
            'title'        => 'required|max:80',
            'training'     => 'required|exists:trainings,id',
            'speaker'      => 'required|max:80',
            'email'        => 'required_without:status|email|max:255',
            'location'     => 'required|max:80',
            'description'  => 'required|max:140',
            'language'     => 'required|max:80',
            'date'         => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'status'       => 'in:1,2,3,4',
        ];
    }
}
