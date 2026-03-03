<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // --- Role helpers (replaces Spatie) ---

    public function hasRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : explode('|', $roles);
        return in_array($this->role, $roles);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isComposer(): bool
    {
        return $this->role === 'composer';
    }

    public function isSinger(): bool
    {
        return $this->role === 'singer';
    }

    // --- Relationships ---

    public function compositions()
    {
        return $this->hasMany(Composition::class);
    }
}