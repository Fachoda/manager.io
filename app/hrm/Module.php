<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 18:31
 */

namespace app\hrm;


use Phalcon\Mvc\Dispatcher as PhDispatcher;

class Module extends \app\base\core\Module
{
    protected function getConfigFile()
    {
        return require(__DIR__ . '/config/config.php');
    }

    /**
     * set the default dispatcher for the hrm module
     *
     * @return PhDispatcher
     */
    protected function getDispatcher()
    {
        $dispatcher = new PhDispatcher();

        /*$eventManager = new Manager();
        $eventManager->attach('dispatch', new \Acl('frontend'));

        $dispatcher->setEventsManager($eventManager);*/
        $dispatcher->setDefaultNamespace('app\hrm\controllers');

        return $dispatcher;
    }
}
