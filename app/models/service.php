<?php
namespace App\models;


use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $fillable  = [
        'name',
        'image',
        'name_ar',
        'name_en'
    ];
    public function sub_servics()
    {
        return $this->hasMany('App\models\sub_service');
    }
    public function TextTrans($text, $locale)
    {
        $column=$text.'_'.$locale;
        return $this->{$column};
    }
}
