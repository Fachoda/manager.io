<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\common\models;

/**
 * Class CoreRoleActions
 * @package app\common\models
 */
class CoreRoleActions extends base\AbstractCoreRoleActions
{
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('action_id', 'app\common\models\CoreActions', 'id', ['alias' => 'CoreActions']);
        $this->belongsTo('role_id', 'app\common\models\CoreRoles', 'id', ['alias' => 'CoreRoles']);
    }
}
