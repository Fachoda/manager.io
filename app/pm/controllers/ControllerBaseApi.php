<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 13.12.2015
 * Time: 18:52
 */

namespace app\pm\controllers;


abstract class ControllerBaseApi extends ControllerBase
{
    protected $_isJsonResponse = false;

    // Call this func to set json response enabled
    public function setJsonResponse()
    {
        $this->view->disable();

        $this->_isJsonResponse = true;
        $this->response->setContentType('application/json', 'UTF-8');
    }

    // After route executed event
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        if ($this->_isJsonResponse) {
            $data = $dispatcher->getReturnedValue();
            if (is_array($data)) {
                $data = json_encode($data);
            }

            $this->response->setContent($data);
        }
    }
}