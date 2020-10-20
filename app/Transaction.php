<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use LogsActivity;

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_customer', 'id_user', 'code', 'total_harga', 'start_date', 'end_date'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'transactions';
    protected static $logAttributes = ['id_customer', 'id_user', 'code', 'total_harga', 'start_date', 'end_date'];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} transaction model";
    }

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
