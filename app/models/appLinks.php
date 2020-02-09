<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class appLinks extends Model
{
    protected $table = 'app_links';
    protected $fillable = [
        'link'
    ];
}
