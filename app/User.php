<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = Hash::make($password);
    }

    public function expanse(){
        return $this->hasMany('App\Expanse', 'id_user');
    }

    public function karyawan(){
        return $this->hasOne('App\Karyawan', 'id_user');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction', 'id_user');
    }

    public function isAdmin(){
        return $this->role == 'admin';
    }

    public function isKaryawan(){
        return $this->role = 'karyawan';
    }
}
