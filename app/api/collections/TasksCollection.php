<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:17
 */

namespace app\api\collections;

use app\api\controllers\TasksController;
use Phalcon\Mvc\Micro\Collection as PhCollection;

class TasksCollection extends PhCollection
{
    public function __construct()
    {
        $this->setHandler(new TasksController());
        $this->setPrefix('tasks');

        $this->get('/', 'index');
        $this->post('/', 'create');
        $this->put('/{task_id}', 'update');
        $this->get('/{task_id}', 'view');
        $this->delete('/{task_id}', 'delete');
    }
}