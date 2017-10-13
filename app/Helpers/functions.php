<?php

function isRouteActive($route, $className = 'active', $withoutClassWord = false)
{
    if (Route::currentRouteName() == $route) {
        if (!$withoutClassWord) {
            return ' class=' . $className;
        }
        return $className;
    }
}