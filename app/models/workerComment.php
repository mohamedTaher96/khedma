<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class workerComment extends Model
{
    protected $fillable  = [
        'comment',
        'worker_id',
        'user_id',

    ];
    public function user()
    {
        return $this->belongsTo('App\models\User');
    }
}
