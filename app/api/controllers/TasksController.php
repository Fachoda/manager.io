<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:06
 */

namespace app\api\controllers;

use app\api\models\Task;
use app\api\transformers\TaskTransformer;
use PhalconRest\Exceptions\Exception;

class TasksController extends ControllerBase
{
    public function index()
    {
        $tasks = Task::find();

        return $this->respondCollection($tasks, new TaskTransformer(), 'tasks');
    }

    public function view($task_id)
    {
        $task = Task::findFirst([
            ['task_id' => $task_id]
        ]);

        return $this->respondItem($task, new TaskTransformer(), 'task');
    }

    public function create()
    {
        $data = $this->request->getJsonRawBody();

        $task = new Task();
        $task->assign((array) $data);

        if (!$task->save()) {
            throw new Exception('Could not save project');
        }

        return $this->respondItem($task, new TaskTransformer(), 'task');
    }

    public function update($task_id)
    {
        $data = $this->request->getJsonRawBody();

        /**
         * @var $task Task
         */
        $task = Task::findById($task_id);
        $task->assign((array) $data);

        if (!$task->save()) {
            throw new Exception('Could not save project');
        }

        return $this->respondItem($task, new TaskTransformer(), 'task');
    }

    public function delete($task_id)
    {
        $task = Task::findById($task_id);

        if (!$task->delete()) {
            throw new Exception('Could not delete the task');
        }

        return $this->respondOK();
    }
}