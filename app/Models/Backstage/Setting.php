<?php

namespace App\Models\Backstage;


use App\Models\Model;
use Illuminate\Database\QueryException;

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
        try{
            return self::where('key',$key)->first()->value;
        }catch (\ErrorException $errorException){
            return '';
        }
    }
    private static function saveSetting($key,$value){
        return self::where('key',$key)->update([$key=>$value]);
    }
}
