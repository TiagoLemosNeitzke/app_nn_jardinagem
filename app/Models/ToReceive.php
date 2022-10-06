<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToReceive extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'expiration_day', 'value', 'paid_out'];
    protected $table = 'to_receive';
}
