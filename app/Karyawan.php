<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Karyawan extends Model
{
    use LogsActivity;

    protected $table = 'karyawans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'alamat', 'telephone', 'gender'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'karyawans';
    protected static $logAttributes = ['id_user', 'alamat', 'telephone', 'gender'];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} karyawan model";
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
