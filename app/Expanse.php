<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expanse extends Model
{
    protected $table = 'expanses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'deskripsi', 'harga', 'catatan'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
