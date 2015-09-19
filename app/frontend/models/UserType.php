<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:20 PM
 */

namespace app\frontend\models;

/**
 * Class UserType
 * @package app\frontend\models
 */
class UserType extends \app\common\models\UserType
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\frontend\models\UserEntity', 'type_id', ['alias' => 'UserEntity']);
    }
}
