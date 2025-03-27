<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'id_number',
        'educational_status',
        'year_level',
        'last_year_attended_or_year_graduated',
        'email',
        'contact_number',
        'program',
        'college',
        'password',
        'role',
        'status',
        'e_signature',
        'e_path',
        'picture_passport',
        'picture_passport_path',
        'picture_2x2',
        'picture_2x2_path'
    ];

    public function program(){
        return $this->belongsTo(Program::class);
    }

    // public function requests(){
    //     return $this->hasMany(Request::class, 'email', 'email');
    // }

    // public function notifications(){
    //     return $this->hasMany(Notification::class, 'email', 'email');
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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
}
