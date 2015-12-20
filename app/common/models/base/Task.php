<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 18:36
 */

namespace app\common\models\base;

use app\base\models\Collection;

class Task extends Collection
{
    /**
     * get the collection name
     *
     * @return string
     */
    public function getSource()
    {
        return 'task';
    }

    /**
     * @var integer
     */
    public $project_id;

    /**
     * @var integer
     */
    public $task_id;

    /**
     * @var string
     */
    public $title;

    /**
     * @param $project_id
     * @return $this
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;

        return $this;
    }

    /**
     * @param $task_id
     * @return $this
     */
    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;

        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $project_id
     * @return $this
     */
    public function getProjectId($project_id)
    {
        $this->project_id = $project_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}