<?php

namespace App\Models\Admin;


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
        if (empty($GLOBALS['setting'])){
            $GLOBALS['setting'] = array();
        }
        if (isset($GLOBALS['setting'][$key])){
            return $GLOBALS['setting'][$key];
        }
        try{
            $GLOBALS['setting'][$key] = self::where('key',$key)->first()->value;
        }catch (\ErrorException $errorException){
            $GLOBALS['setting'][$key] = '';
        }
        return $GLOBALS['setting'][$key];
    }
    private static function saveSetting($key,$value){
        if (!isset($_SETTING)){
            define('_SETTING',array());
        }
        $_SETTING[$key] = $value;
        return self::where('key',$key)->update([$key=>$value]);
    }
}
