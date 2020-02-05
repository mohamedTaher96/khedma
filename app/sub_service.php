<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_service extends Model
{
    protected $fillable  = [
        'name',
        'service_id'
    ];
    public function servive()
    {
        return $this->belongsTo('App\service');
    }
}
