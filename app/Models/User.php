<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

  
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CLIENT = 'client';


    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Añadido para gestión de roles
        'phone',
    'address',

    ];

 
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string', // Añadido para el rol
        ];
    }


    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->role)) {
                $user->role = self::ROLE_CLIENT;
            }
        });
    }
}