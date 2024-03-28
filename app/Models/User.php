<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;


    // const ROLE_SUPERADMIN = 'superadmin';
    // const ROLE_ADMIN = 'admin';
    // const ROLE_NORMAL = 'normal';

    // public function isAdmin() {
    //     return $this->role === self::ROLE_ADMIN || $this->role === self::ROLE_SUPERADMIN;
    // }

    // public function isSuperAdmin() {
    //     return $this->role === self::ROLE_SUPERADMIN;
    // }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'birthdate',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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
}
