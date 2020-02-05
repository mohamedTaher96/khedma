<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $fillable  = [
        'name',
        'image'
    ];
    public function sub_servics()
    {
        return $this->hasMany('App\sub_service');
    }
}
