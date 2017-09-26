<?php

namespace App\Http\Requests\Colloquium;

use App\Colloquium;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->user()->can('create', Colloquium::class));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:80',
            'training_id' => 'required|exists:training,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'speaker' => 'required|max:80',
            'location' => 'required|max:80',
            'description' => 'required|max:140',
            'status' => 'required',
            'language' => 'required|max:80',
        ];
    }
}
