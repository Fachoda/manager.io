<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 17:24
 */

namespace app\api\controllers;

use app\api\transformers\TimeSheetTransformer;
use app\api\models\TimeSheet;
use PhalconRest\Exceptions\Exception;

class TimeSheetsController extends ControllerBase
{
    public function index()
    {
        $timesheets = TimeSheet::find(['limit' => 100]);

        return $this->respondCollection($timesheets, new TimeSheetTransformer(), 'timesheet');
    }

    public function view($timeSheet_id)
    {
        $timeSheet = TimeSheet::findById($timeSheet_id);

        return $this->respondItem($timeSheet, new TimeSheetTransformer(), 'timeSheet');
    }

    public function create()
    {
        $data = $this->request->getJsonRawBody();

        $timesheet = new TimeSheet();
        $timesheet->assign((array) $data);

        if (!$timesheet->save()) {
            throw new Exception('Could not save timesheet');
        }

        return $this->respondItem($timesheet, new TimeSheetTransformer(), 'timesheet');
    }

    public function update($timeSheet_id)
    {
        $data = $this->request->getJsonRawBody();

        /**
         * @var $timesheet TimeSheet
         */
        $timesheet = TimeSheet::findById($timeSheet_id);
        $timesheet->assign((array) $data);

        if (!$timesheet->save()) {
            throw new Exception('Could not save timesheet');
        }

        return $this->respondItem($timesheet, new TimeSheetTransformer(), 'timesheet');
    }

    public function delete($timeSheet_id)
    {
        $timeSheet = TimeSheet::findById($timeSheet_id);

        if (!$timeSheet->delete()) {
            throw new Exception('Could not delete the timesheet');
        }

        return $this->respondOK();
    }
}