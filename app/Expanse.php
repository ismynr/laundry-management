<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Expanse extends Model
{
    use LogsActivity;

    protected $table = 'expanses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'deskripsi', 'harga', 'catatan'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'expanses';
    protected static $logAttributes = ['id_user', 'deskripsi', 'harga', 'catatan'];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} expanse model";
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
