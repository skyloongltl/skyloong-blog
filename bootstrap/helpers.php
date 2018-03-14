<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function is_active($route_name, $params = [])
{
    $current_url = URL::current();
    $link = route($route_name, $params);
    if($link == $current_url){
        return 'active';
    }
}

function replace($matches)
{
    return '<em style="color:#ff020a">' . $matches[0] . '</em>';
}

function selectColor()
{
    static $colors = ['skyblue', '#FFCC99', '#FF6666'];

    $color = current($colors);
    if($color === false){
        $color  = reset($colors);
        next($colors);
        return $color;
    }
    next($colors);
    return $color;
}