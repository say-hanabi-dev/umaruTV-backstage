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