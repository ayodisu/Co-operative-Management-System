<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function getProfilePictureUrlAttribute()
    {
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&color=7F9CF5&background=EBF4FF";
    }
}
