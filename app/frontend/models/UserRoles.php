<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\frontend\models;

/**
 * Class UserRoles
 * @package app\frontend\models
 */
class UserRoles extends \app\common\models\UserRoles
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->belongsTo('role_id', 'app\frontend\models\CoreRoles', 'id', ['alias' => 'CoreRoles']);
        $this->belongsTo('user_id', 'app\frontend\models\UserEntity', 'id', ['alias' => 'UserEntity']);
    }
}
