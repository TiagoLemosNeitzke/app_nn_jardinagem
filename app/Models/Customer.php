<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'phone',
        'street',
        'street_number',
        'district',
        'city',
        'state'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
