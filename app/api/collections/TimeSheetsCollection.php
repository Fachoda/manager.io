<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 17:20
 */

namespace app\api\collections;

use app\api\controllers\TimeSheetsController;
use Phalcon\Mvc\Micro\Collection as PhCollection;

class TimeSheetsCollection extends PhCollection
{
    public function __construct()
    {
        $this->setHandler(new TimeSheetsController());
        $this->setPrefix('timesheets');

        $this->get('/', 'index');
        $this->post('/', 'create');
        $this->put('/{timeSheet_id}', 'update');
        $this->get('/{timeSheet_id}', 'view');
        $this->delete('/{timeSheet_id}', 'delete');
    }
}