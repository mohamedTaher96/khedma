<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class worker extends Model
{
    protected $table = 'workers';
    protected $fillable  = [
        'name',
        'email',
        'number',
        'password',
        'directions',
        'image',
        'about',
        'city',
        'area',
        'adress',
        'api_token'
    ];

}
