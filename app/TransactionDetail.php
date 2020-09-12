<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_transaction', 'id_package', 'qty', 'harga', 'status'
    ];

    public function transaction(){
        return $this->belongsTo('App\Transaction', 'id_transaction');
    }

    public function package(){
        return $this->belongsTo('App\Package', 'id_package');
    }
}
