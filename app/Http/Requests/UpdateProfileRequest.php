<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateProfileRequest extends FormRequest
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
        $id = $this->user()->id;
        return [
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|max:255|unique:users,email,' . $id
        ];
    }
}
