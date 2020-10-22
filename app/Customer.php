<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use LogsActivity;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'alamat', 'telephone', 'gender'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'customers';
    protected static $logAttributes = ['name', 'alamat', 'telephone', 'gender'];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} customer model";
    }

    public function transaction() {
        return $this->hasMany('App\Transaction');
    }
}
