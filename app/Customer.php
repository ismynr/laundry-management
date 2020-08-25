<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'alamat', 'telephone', 'gender', 'point'
    ];

    public function transaction() {
        return $this->hasMany('App\Transaction');
    }
}
