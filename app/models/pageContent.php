<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class pageContent extends Model
{
    protected $table = 'page_content';
    protected $fillable = [
        'ar_content', 'en_content'
    ];
}
