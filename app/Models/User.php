<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_avatar_url',
        'status',
        'invite_token',
        'invited_at',
        'avatar_color'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function countAllRecords()
    {
        return $this->withTrashed()
            ->count();
    }

    public function countAllAdmins()
    {
        return $this->withTrashed()->where('role', 0)
            ->count();
    }

    public function countAllJournalists()
    {
        return $this->withTrashed()->where('role', 1)
            ->count();
    }

    public function countAllUsers()
    {
        return $this->withTrashed()->where('role', 2)
            ->count();
    }
}
