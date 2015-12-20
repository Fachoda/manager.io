<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:53
 */

namespace app\base\fractal;

use \PhalconRest\Constants\Services as AppServices;

class UrlQuery extends \PhalconRest\Mvc\Plugin
{
    const QUERY = 'query';
    const URL_QUERY_PARSER = 'urlQueryParser';

    public function beforeExecuteRoute(\Phalcon\Events\Event $event, \Phalcon\Mvc\Micro $app)
    {
        $params = $this->getDI()->get(AppServices::REQUEST)->getQuery();
        $query = $this->getDI()->get(static::URL_QUERY_PARSER)->createQuery($params);
        $this->getDI()->get(static::QUERY)->merge($query);
    }
}
