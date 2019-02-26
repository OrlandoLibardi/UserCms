<?php

namespace OrlandoLibardi\UserCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserDeleteRequest extends FormRequest
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
            'id' => 'required'
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
            'id.required' => 'Você deve selecionar um ou mais itens.'
        ];
    }

}
//$this->user->id
