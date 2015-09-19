<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:21 PM
 */

namespace app\frontend\models;

/**
 * Class CoreActions
 * @package app\frontend\models
 */
class CoreActions extends \app\common\models\CoreActions
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\frontend\models\CoreRoleActions', 'action_id', ['alias' => 'CoreRoleActions']);
    }
}
