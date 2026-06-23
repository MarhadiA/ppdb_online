<?php

namespace App\Models;

use Database\Factories\UserFactory;
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
        'role', // penting untuk PPDB
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
        ];
    }

    // ======================
    // RELASI
    // ======================
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // ======================
    // ROLE HELPERS
    // ======================
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPanitia()
    {
        return $this->role === 'panitia';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}