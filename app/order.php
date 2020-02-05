<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable  = [
        'service',
        'sub_service',
        'service_image',
        'city',
        'area',
        'location',
        'info',
        'order_number',
        'user_id'
    ];

    public function offers()
    {
        return $this->hasMany('App\offer');
    }

}
