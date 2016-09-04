<?php

namespace ATLauncher\Http\Requests;

class DeleteRole extends FormRequest
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
            'id' => 'required|integer|exists:roles,id|exists:role_user,role_id,user_id,' . $this->route('id')
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.exists' => 'A role with that id doesn\'t exist.'
        ];
    }
}
