<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'customer_id',
        'schedule_for_day',
        'service_value',
        'did_day'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
