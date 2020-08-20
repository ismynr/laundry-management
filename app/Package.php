<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_service', 'nama_paket', 'tipe_berat', 'harga'
    ];

    public function service(){
        return $this->belongsTo('App\Service', 'id_service');
    }

}
