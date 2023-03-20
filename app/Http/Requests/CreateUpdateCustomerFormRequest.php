<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCustomerFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'required|numeric',
            'street' => 'required',
            'street_number' => 'required|',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required|min:2|max:2'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Campo obrigatório.",
            'email.email' => "Preencha com um email válido.",
            'phone.required' => "Campo obrigatório.",
            'phone.numeric' => "Digite somente números",
            'street.required' => "Campo obrigatório.",
            'street_number.required' => "Campo obrigatório.",
            'district.required' => "Campo obrigatório.",
            'city.required' => "Campo obrigatório.",
            'state.required' => "Campo obrigatório.",
            'state.min' => "Digite somente a sigla do estado.",
            'state.max' => "Digite somente a sigla do estado",
        ];
    }
}
