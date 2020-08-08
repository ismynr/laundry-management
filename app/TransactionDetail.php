<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'id';

    public function transaction(){
        return $this->belongsTo('App\Transaction', 'id_transaction');
    }

    public function package(){
        return $this->belongsTo('App\Package', 'id_package');
    }
}
