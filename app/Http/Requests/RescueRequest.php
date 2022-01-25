<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RescueRequest extends FormRequest
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
            'reporter' => 'required',
            'organization_id' => 'required',
            'name' => 'required',
            'cep' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',
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
            'reporter.required'  =>  'O denunciador é obrigatório',
            'name.required'  =>  'O nome é obrigatório',
            'organization_id.required'  =>  'O envio de organization_id é obrigatório',
            'cep.required'  =>  'O envio de cep é obrigatório',
            'address.required'  =>  'O envio de endereco é obrigatório',
            'neighborhood.required'  =>  'O envio de bairro é obrigatório',
            'state.required'  =>  'O envio de estado é obrigatório',
            'city.required'  =>  'O envio de cidade é obrigatório',
        ];
    }
}
