<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\frontend\models;

/**
 * Class CoreRoleActions
 * @package app\frontend\models
 */
class CoreRoleActions extends \app\common\models\CoreRoleActions
{
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('action_id', 'app\frontend\models\CoreActions', 'id', ['alias' => 'CoreActions']);
        $this->belongsTo('role_id', 'app\frontend\models\CoreRoles', 'id', ['alias' => 'CoreRoles']);
    }
}
