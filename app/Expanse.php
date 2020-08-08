<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expanse extends Model
{
    protected $table = 'expanses';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
