<?php

/**
 * Check for ajax requests filter
 */

namespace manager\router\filters;

class AjaxFilter
{
    public function check()
    {
        return $_SERVER['HTTP_X_REQUESTED_WITH'] == 'xmlhttprequest';
    }
}