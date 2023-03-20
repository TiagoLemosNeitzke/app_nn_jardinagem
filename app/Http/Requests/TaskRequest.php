<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'customer_id' => 'required',
            'scheduled_for_day' => 'required|date',
            'service_value' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'O Campo é obrigatório.',
            'customer_id.required' => 'O Campo é obrigatório.',
            'scheduled_for_day.required' => 'O Campo é obrigatório.',
            'schedule_for_day.date' => 'Insira uma data.',
            'service_value.required' => 'O Campo é obrigatório.',
            'service_value.integer' => 'Insira um valor numérico inteiro. '
        ];

        
    }
}
