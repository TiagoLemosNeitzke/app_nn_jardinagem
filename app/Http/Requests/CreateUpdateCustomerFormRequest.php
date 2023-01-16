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
            'state' => 'required'
        ];
    }
}
