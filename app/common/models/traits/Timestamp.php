<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 3:14 PM
 */

namespace app\common\models\traits;

/**
 * Ensure that the model gets the timestamp on create and update
 *
 * Trait Timestamp
 * @package app\common\models\traits
 */
trait Timestamp
{
    /**
     * set the created date
     */
    public function beforeCreate()
    {
        // Timestamp the creation of the new user
        $this->setCreatedAt(date('Y-m-d H:i:s'));
    }

    /**
     * set the updated date
     */
    public function beforeUpdate()
    {
        // Timestamp the update of the user
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
    }
}