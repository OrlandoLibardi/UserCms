<?php

namespace OrlandoLibardi\UserCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'role' => 'required'
        ];
    }
     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'O endereço de e-mail não é válido.',
            'email.unique' => 'Endereço de e-mail já cadastrado.',
            'role.required' => 'Você deve selecionar o nível do usuário.'
        ];
    }
}
