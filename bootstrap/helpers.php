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