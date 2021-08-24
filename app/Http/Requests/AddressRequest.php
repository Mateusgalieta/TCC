<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'cep' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
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
            'cep.required'  =>  'O cep é obrigatório',
            'address.required'  =>  'O address é obrigatório',
            'neighborhood.required'  =>  'O neighborhood é obrigatório',
            'city.required'  =>  'O city é obrigatório',
            'state.required'  =>  'O state é obrigatório',
            'organization_id.required'  =>  'O organization_id é obrigatório',
        ];
    }
}
