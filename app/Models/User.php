<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship: Each user has one member profile.
     */
    public function profile()
    {
        return $this->hasOne(MemberProfile::class);
    }

    /**
     * Role helpers for clarity.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isLoanOfficer(): bool
    {
        return $this->role === 'loan_officer';
    }

    public function isMember(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Shortcut attribute for views.
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketMessages()
    {
        return $this->hasMany(TicketMessage::class);
    }
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile && $this->profile->profile_picture) {
            return asset('storage/' . $this->profile->profile_picture);
        }

        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&color=7F9CF5&background=EBF4FF";
    }
}
