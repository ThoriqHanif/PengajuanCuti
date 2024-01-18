<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'telp',
        'email',
        'password',
        'address',
        'entry_date',
        'division_id',
        'position_id',
        'manager_id',
        'role_id',
        

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
        'password' => 'hashed',
    ];

    public function division()
    {
        return $this->belongsTo(Divisions::class);
    }

    public function position()
    {
        return $this->belongsTo(Positions::class);
    }

    public function manager()
    {
        // Jika positions selain staff memiliki user sebagai manager
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }
}
