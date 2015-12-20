<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 18:28
 */

namespace app\common\models\base;

use app\base\models\Collection;

abstract class User extends Collection
{
    /**
     * get the collection name
     *
     * @return string
     */
    public function getSource()
    {
        return 'user';
    }

    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @param $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @param $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @param $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

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
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
}