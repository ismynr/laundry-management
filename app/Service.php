<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use LogsActivity;

    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'service_type'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'services';
    protected static $logAttributes = ['service_type'];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} service model";
    }
    
    public function package(){
        return $this->hasMany(App\Package::class);
    }
}
