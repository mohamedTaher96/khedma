<?php
namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sub_service extends Model
{
    protected $fillable  = [
        'name',
        'service_id',
        'en_form'
    ];
    public function servive()
    {
        return $this->belongsTo('App\models\service');
    }
}
