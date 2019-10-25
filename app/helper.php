<?php

use App\Models\Admin\Setting;

if (!function_exists('ee')){
    function ee(...$args){
        foreach ($args as $arg) {
            if (!empty($arg)){
                return $arg;
            }
        }
    }
}
if (!function_exists('route_class')){
    function route_class(){
        return str_replace('.','-',Route::currentRouteName());
    }
}
function array_filter_key(array $input, array $key){
    return array_filter($input,function ($i)use($key){
        return in_array($i,$key);
    },ARRAY_FILTER_USE_KEY);
}
function setting($key,$value = null){
    return Setting::setting($key,$value);
}