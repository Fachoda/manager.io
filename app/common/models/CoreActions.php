<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\common\models;

/**
 * Class CoreActions
 * @package app\common\models
 */
class CoreActions extends base\AbstractCoreActions
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\common\models\CoreRoleActions', 'action_id', ['alias' => 'CoreRoleActions']);
    }
}
