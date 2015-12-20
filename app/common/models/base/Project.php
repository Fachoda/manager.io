<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 18:32
 */

namespace app\common\models\base;

use app\base\models\Collection;

class Project extends Collection
{
    /**
     * get the collection name
     *
     * @return string
     */
    public function getSource()
    {
        return 'project';
    }

    /**
     * @var integer
     */
    public $project_id;

    /**
     * @var integer
     */
    public $client_id;

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
     * @param $client_id
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

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
     * @return int
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}