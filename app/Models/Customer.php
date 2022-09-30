<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name','email', 'phone', 'address','type_service', 'service_price', 'is_monthly', 'expiration_day'];
}
