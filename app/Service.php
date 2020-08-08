<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';

    public function package(){
        return $this->hasMany('App\Package');
    }
}
