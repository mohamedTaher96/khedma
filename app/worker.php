<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class worker extends Model
{
    protected $table = 'workers';
    protected $fillable  = [
        'name',
        'email',
        'number',
        'from',
        'to',
        'password',
        'directions',
        'image',
        'about'
    ];

}
