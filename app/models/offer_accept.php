<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class offer_accept extends Model
{
    protected $table = 'offer_accept';
    protected $fillable = [
        'payment', 'offer_id',];

}
