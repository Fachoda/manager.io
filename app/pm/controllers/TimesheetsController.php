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
        $model = TimeSheet::find();

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
                'user_id' => $i,
                'work_type_id' => $i,
                'entity_id' => $i,
                'entity_type' => $i,
                'duration' => $i,
                'start_time' => '2015-12-13',
                'description' => 'test',
                'billable' => true,
                'date' => '2015-12-13',
                'date_added' => '2015-12-13'
            ]);

            if (!$model->save()) {
                foreach ($model->getMessages() as $message) {
                    echo $message . PHP_EOL;
                }
            }
        }
    }
}