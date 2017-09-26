<?php

namespace App\Http\Requests\Training;

use App\Training;
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
        return ($this->user()->can('update', Training::class));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $training = $this->route('training');
        $id = $training->id;

        return [
            'name' => 'max:80|unique:trainings,name,'.$id,
            'color' => 'max:8|unique:trainings,color,'.$id,
        ];
    }
}
