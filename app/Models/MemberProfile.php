<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'occupation',
        'date_of_birth',
        'gender',
        'date_of_appointment',
        'grade_level',
        'department',
        'retirement_year',
        'monthly_contribution',
        'total_contributions',
        'current_loan_balance',
        'profile_picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
