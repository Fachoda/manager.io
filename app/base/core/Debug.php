<?php

/**
 * offer shortcuts for easier debugging
 */

if (!function_exists('vd')) {
    /**
     * var_dump()
     */
    function vd($data)
    {
        var_dump($data);
    }
}

if (!function_exists('pr')) {
    /**
     * print_r()
     */
    function pr($data, $return = false)
    {
        if ($return) {
            return print_r($data, true);
        } else {
            print_r($data);
        }
    }
}

if (!function_exists('vdd')) {
    /**
     * var_dump() + die()
     */
    function vdd($data)
    {
        var_dump($data);
        exit();
    }
}

if (!function_exists('prd')) {
    /**
     * print_r() + die();
     */
    function prd($data, $return = false)
    {
        if ($return) {
            return print_r($data, true);
        } else {
            print_r($data);
        }
    }
}