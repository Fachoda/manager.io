<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 13.12.2015
 * Time: 11:38
 */

namespace app\common\models\base;

use app\base\models\Collection;

abstract class TimeSheet extends Collection
{
    /**
     * get the collection name
     *
     * @return string
     */
    public function getSource()
    {
        return 'time_sheet';
    }

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var integer
     */
    public $work_type_id;

    /**
     *
     * @var integer
     */
    public $entity_id;

    /**
     *
     * @var string
     */
    public $entity_type;

    /**
     *
     * @var float
     */
    public $duration;

    /**
     *
     * @var string
     */
    public $start_time;

    /**
     *
     * @var string
     */
    public $description;

    /**
     * @var boolean
     */
    public $billable;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $date_added;

    /**
     * @param mixed $user_id
     * @return $this
     */
    public function setId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @param $work_type_id
     * @return $this
     */
    public function setWorkTypeId($work_type_id)
    {
        $this->work_type_id = $work_type_id;

        return $this;
    }

    /**
     * @param $entity_id
     * @return $this
     */
    public function setEntityId($entity_id)
    {
        $this->entity_id = $entity_id;

        return $this;
    }

    /**
     * @param $entity_type
     * @return $this
     */
    public function setEntityType($entity_type)
    {
        $this->entity_type = $entity_type;

        return $this;
    }

    /**
     * @param $duration
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @param $start_time
     * @return $this
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param $billable
     * @return $this
     */
    public function setBillable($billable)
    {
        $this->billable = $billable;

        return $this;
    }

    /**
     * @param $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param $date_added
     * @return $this
     */
    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getWorkTypeId()
    {
        return $this->work_type_id;
    }

    /**
     * @return int
     */
    public function getEntityId()
    {
        return $this->entity_id;
    }

    /**
     * @return string
     */
    public function getEntityType()
    {
        return $this->entity_type;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function getBillable()
    {
        return $this->billable;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }
}