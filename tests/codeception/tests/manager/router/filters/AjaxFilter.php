<?php

/**
 * Check for ajax requests filter
 */

namespace tests\manager\router\filters;

class AjaxFilter
{
    public function check()
    {
        return $_SERVER['HTTP_X_REQUESTED_WITH'] == 'xmlhttprequest';
    }
}