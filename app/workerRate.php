<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class workerRate extends Model
{
    protected $fillable  = [
        'rate',
        'worker_id',
        'user_id',
    ];
}
