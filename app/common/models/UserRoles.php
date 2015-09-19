<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\common\models;

/**
 * Class UserRoles
 * @package app\common\models
 */
class UserRoles extends base\AbstractUserRoles
{

    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->belongsTo('role_id', 'app\common\models\CoreRoles', 'id', ['alias' => 'CoreRoles']);
        $this->belongsTo('user_id', 'app\common\models\UserEntity', 'id', ['alias' => 'UserEntity']);
    }
}
