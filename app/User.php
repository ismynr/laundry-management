<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function expanse(){
        return $this->hasMany('App\Expanse');
    }

    public function karyawan(){
        return $this->hasOne('App\Karyawan');
    }

    public function package(){
        return $this->hasMany('App\Package');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

    public function isAdmin(){
        return $this->role == 'admin';
    }

    public function isKaryawan(){
        return $this->role = 'karyawan';
    }
}
