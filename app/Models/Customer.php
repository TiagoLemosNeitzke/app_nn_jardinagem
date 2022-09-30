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
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'required',
            'address' => 'required',
            'type_service' => 'required',
            'service_price' => 'required',
            'is_monthly' => 'required|boolean',
            'expiration_day' => 'integer|starts_with:1,31'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O campo email está incorreto.',
            'boolean' => 'Erro ao validar o campo.',
            'integer' => 'O campo precisar ser preenchido com um número inteiro',
            'starts_with' => 'Preencha o campo com números entre 1 e 31'
        ];
    }
}
