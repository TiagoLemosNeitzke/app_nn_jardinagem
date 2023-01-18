<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function task()
    {
        return $this->hasOne(Task::class);
    }

    public function toReceive()
    {
        return $this->hasOne(ToReceive::class);
    }
}
