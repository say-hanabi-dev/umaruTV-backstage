<?php

namespace App\Models\Backstage;


use App\Models\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $connection = 'sqlite';
    protected $fillable = [
        'key','value','type'
    ];

    public static function setting($key,$value = null){
        if (empty($value)){
            return self::getSetting($key);
        }else{
            return self::saveSetting($key,$value);
        }
    }

    private static function getSetting($key){
        return self::where('key',$key)->first()->value;
    }
    private static function saveSetting($key,$value){
        return self::where('key',$key)->update([$key=>$value]);
    }
}
