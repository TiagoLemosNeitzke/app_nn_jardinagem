<?php

namespace App\Models;

use App\Enums\ToReceiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class To_Receive extends Model
{
    use HasFactory;
    protected $fillable = ['id','task_id','user_id', 'customer_id', 'value', 'status'];
    protected $table = 'to_receive';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status' => ToReceiveStatus::class
    ];
}
