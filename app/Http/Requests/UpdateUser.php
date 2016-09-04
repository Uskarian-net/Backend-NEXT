<?php

namespace ATLauncher\Http\Requests;

class UpdateUser extends FormRequest
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
            'username' => 'sometimes|unique:users,username|min:3|max:64|not_in:admin,root,atlauncher',
            'email' => 'sometimes|unique:users,email|max:255|email',
            'password' => 'sometimes|min:6',
            'must_change_password' => 'sometimes|boolean'
        ];
    }
}
