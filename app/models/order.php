<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable  = [
        'service',
        'sub_service',
        'service_image',
        'city',
        'area',
        'help_image',
        'location',
        'info',
        'order_number',
        'user_id'
    ];

    public function offers()
    {
        return $this->hasMany('App\models\offer');
    }

}
