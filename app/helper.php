<?php
if (!function_exists('')){
    function choose_value(...$args){
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