<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'duration_months',
        'purpose',
        'status',
        'admin_remark',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function getAmountRepaidAttribute()
    {
        return $this->repayments->sum('amount');
    }

    public function getBalanceRemainingAttribute()
    {
        return $this->amount - $this->amount_repaid;
    }
}
