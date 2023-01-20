<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseToPay extends Model
{
    use HasFactory;

    protected $table = 'expenses_to_pay';
    
    protected $fillable = [
        'user_id',
        'expense_amount',
        'description',
        'due_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
