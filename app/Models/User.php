<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Admin;

use App\Models\ForgotPassword;
use App\Models\Device;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role_user',
        'active',
        'password_raw',
        'expired_date',
        'number_devices',
        'country',
        'phone',
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


    public function isRole($role=''){
        return Admin::user()->role_user == $role;
    }

    public function inRoles($roles=[]){
        return in_array(Admin::user()->role_user, $roles);
    }

    public function forgotPassword(){
        return $this->hasOne(ForgotPassword::class, 'user_id', 'id');
    }

    public function devices(){
        return $this->hasMany(Device::class, 'user_id', 'id');
    }
}
