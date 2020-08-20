<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'service_type'
    ];

    public function package(){
        return $this->hasMany(App\Package::class);
    }
}
