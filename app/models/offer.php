<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $fillable = [
        'worker_id', 'cast', 'order_id'
    ];
    protected $with =['worker'];
    public function worker()
    {
        return $this->belongsTo('App\models\worker');
    }


}
