<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
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
            'name.required'  =>  'O nome é obrigatório',
            'email.required' =>  'O email é obrigatório',
            'email.email'    =>  'O formato do email está incorreto',
            'email.unique'   =>  'Esse email já existe no sistema',
            'password.required'  =>  'É necessário colocar uma senha',
        ];
    }
}
