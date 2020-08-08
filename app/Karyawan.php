<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
