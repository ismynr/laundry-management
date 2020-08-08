<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function service(){
        return $this->belongsTo('App\Service', 'id_service');
    }

    public function package(){
        return $this->hasMany('App\Package');
    }
}
