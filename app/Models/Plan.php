<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];
    protected $table = 'plans';

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
