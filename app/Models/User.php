<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password',
        'fonction', 'tele', 'userName', 'mac',
        'strg1', 'strg2', 'strg3', 'strg4',
        'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9',
        'school_id','is_admin',  // Added for school relationship
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // Optionally add casts for boolean privileges
            'p1' => 'boolean',
            'p2' => 'boolean',
            // ... repeat for p3 to p9 if needed
            
        ];
    }

    /**
     * School relationship
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // app/Models/User.php
    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
