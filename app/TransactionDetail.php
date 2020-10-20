<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class TransactionDetail extends Model
{
    use LogsActivity;

    protected $table = 'transaction_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_transaction', 'id_package', 'qty', 'harga', 'status'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'transaction item';
    protected static $logAttributes = ['id_transaction', 'id_package', 'qty', 'harga', 'status'];
    protected static $recordEvents = ['created', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} transaction detail model";
    }

    public function transaction(){
        return $this->belongsTo('App\Transaction', 'id_transaction');
    }

    public function package(){
        return $this->belongsTo('App\Package', 'id_package');
    }
}
