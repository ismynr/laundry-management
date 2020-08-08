<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';

    public function customer(){
        return $this->belongsTo('App\Customer', 'id_customer');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function transactionDetail(){
        return $this->hasOne('App\TransactionDetail');
    }
}
