<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_customer', 'id_user', 'code', 'total_harga', 'start_date', 'end_date'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer', 'id_customer');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function transactionDetail(){
        return $this->hasMany('App\TransactionDetail', 'id_transaction');
    }
}
