<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\frontend\models;

/**
 * Class CoreRoles
 * @package app\frontend\models
 */
class CoreRoles extends \app\common\models\CoreRoles
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\frontend\models\CoreRoleActions', 'role_id', ['alias' => 'CoreRoleActions']);
        $this->hasMany('id', 'app\frontend\models\UserRoles', 'role_id', ['alias' => 'UserRoles']);
    }
}
