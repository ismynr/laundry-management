<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model
{
    use LogsActivity;

    protected $table = 'packages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_service', 'nama_paket', 'tipe_berat', 'harga'
    ];

    // LOG ACTIVITY SPATIE
    protected static $logName = 'packages';
    protected static $logAttributes = ['id_service', 'nama_paket', 'tipe_berat', 'harga'];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return ":causer.name has {$eventName} package model";
    }

    public function service(){
        return $this->belongsTo('App\Service', 'id_service');
    }

}
