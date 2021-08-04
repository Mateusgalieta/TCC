<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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
            'code' => 'required|unique:animals',
            'rescue_hour' => 'required|date_format:"Y-m-d H:i"',
            'rescuer_name' => 'required',
            'partner_organization' => 'required',
            'organization_id' => 'required',
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
            'code.required'  =>  'O code é obrigatório',
            'code.unique'  =>  'Já existe um animal com esse código',
            'rescuer_name.required'  =>  'O rescuer_name é obrigatório',
            'rescue_hour.required'  =>  'O rescue_hour é obrigatório',
            'rescue_hour.date_format'  =>  'O rescue_hour precisa ser DateTime',
            'partner_organization.required'  =>  'O partner_organization é obrigatório',
            'organization_id.required'  =>  'O envio de organization_id é obrigatório',
        ];
    }
}
