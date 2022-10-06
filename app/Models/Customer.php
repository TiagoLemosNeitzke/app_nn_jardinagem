<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name','email', 'phone', 'address','type_service', 'service_price', 'is_monthly', 'expiration_day'];

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'email:rfc,dns|nullable',
            'phone' => 'required',
            'address' => 'required',
            'type_service' => 'required',
            'service_price' => 'required',
            'is_monthly' => 'required|boolean',
            'expiration_day' => 'integer'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'O nome precisa ter pelo menos 3 caracteres',
            'max' => 'O nome não pode ter mais de 255 caracteres',
            'email' => 'Email inválido.',
            'boolean' => 'Erro ao validar o campo mensalidade.',
            'integer' => 'O campo precisar ser preenchido com um número inteiro',
        ];
    }
}
