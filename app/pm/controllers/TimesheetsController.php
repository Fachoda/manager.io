<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 13.12.2015
 * Time: 16:24
 */

namespace app\pm\controllers;

use app\pm\forms\timesheet\TimeSheetForm;
use app\pm\models\TimeSheet;

class TimesheetsController extends ControllerBase
{
    public function jsonAction()
    {
        $this->view->disable();

    }

    public function indexAction()
    {
        $model = TimeSheet::find([
            'limit' => 200,
            'sort' => ['id' => 1]
        ]);

        $this->view->model = $model;
    }

    public function createAction()
    {
        $model = new TimeSheetForm();

        $this->view->model = $model;
    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }

    public function dummyAction($num = 1)
    {
        for ($i = 0; $i < 20000; $i++) {
            $model = new TimeSheet();

            $model->assign([
                'user_id' => ($i % 4) + 1,
                'project_id' => ($i % 4) + 1,
                'task_id' => ($i % 5) + 1,
                'duration' => mt_rand(1, 20),
                'description' => 'test ....' . $i,
                'billable' => mt_rand(1, 20) % 5 == 0,
                'start_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +' . mt_rand(0, 100) . 'days')),
                'date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +' . mt_rand(0, 100) . 'days')),
                'date_added' => date('Y-m-d H:i:s')
            ]);

            if (!$model->save()) {
                foreach ($model->getMessages() as $message) {
                    echo $message . PHP_EOL;
                }
            }
        }
    }
}