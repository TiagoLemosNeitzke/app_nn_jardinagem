<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToReceive extends Model
{
    use HasFactory;
   
    protected $fillable = ['id','task_id','user_id', 'customer_id', 'service_value', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

   
}
