<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->user()->can('update', User::class));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $id = $request->get('id');

        return [
            'name' => 'nullable|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$id,
            'role' => 'nullable|in:1,2',
        ];
    }
}
