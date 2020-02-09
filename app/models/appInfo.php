<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class appInfo extends Model
{
    protected $table = 'app_info';
    protected $fillable = [
        'number', 'email'
    ];
}
