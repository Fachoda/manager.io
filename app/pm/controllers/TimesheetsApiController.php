<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 13.12.2015
 * Time: 18:53
 */

namespace app\pm\controllers;

use app\pm\models\TimeSheet;

class TimesheetsApiController extends ControllerBaseApi
{
    public function listAction()
    {
        $this->view->disable();
        $model = TimeSheet::find();

        $this->response->setJsonContent($model);
        $this->response->send();
    }
}