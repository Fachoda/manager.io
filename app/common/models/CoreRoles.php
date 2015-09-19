<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\common\models;

/**
 * Class CoreRoles
 * @package app\common\models
 */
class CoreRoles extends base\AbstractCoreRoles
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\common\models\CoreRoleActions', 'role_id', ['alias' => 'CoreRoleActions']);
        $this->hasMany('id', 'app\common\models\UserRoles', 'role_id', ['alias' => 'UserRoles']);
    }
}
