<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:20 PM
 */

namespace app\common\models;

/**
 * Class UserType
 * @package app\common\models
 */
class UserType extends base\AbstractUserType
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\common\models\UserEntity', 'type_id', ['alias' => 'UserEntity']);
    }
}
