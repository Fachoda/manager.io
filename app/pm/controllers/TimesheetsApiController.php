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
        $model = TimeSheet::find([
            'limit' => 100,
            'sort' => ['user_id' => 1]
        ]);

        $this->response->setJsonContent($model);
        $this->response->send();
    }

    public function updateAction()
    {
        $this->view->disable();
        if ($this->request->isPost()) {
            $postData = $this->request->getPost('json');
            $data = json_decode($postData, true);
            $model = TimeSheet::findById($data['$id']);
            if ($model) {
                $model->assign([
                    $data['column'] => $data['value']
                ]);

                $model->save();
            }
        }
    }
}