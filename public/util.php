<?php

function merge_deep()
{
    $arrays = func_get_args();
    return array_merge_deep($arrays);
}

function array_merge_deep($arrays)
{
    $result = array();

    foreach ($arrays as $array) {
        foreach ($array as $key => $value) {
            // Renumber integer keys as array_merge_recursive() does. Note that PHP
            // automatically converts array keys that are integer strings (e.g., '1')
            // to integers.
            if (is_integer($key)) {
                $result[] = $value;
            } elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                $result[$key] = array_merge_deep(array($result[$key], $value));
            } elseif (isset($result[$key]) && is_string($result[$key])) {
                $result[$key] = (isset($result[$key]) ? $result[$key] . ' ' . $value : $value);
            } else {
                $result[$key] = $value;
            }
        }
    }
    return $result;
}