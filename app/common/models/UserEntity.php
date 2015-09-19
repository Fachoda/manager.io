<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:19 PM
 */

namespace app\common\models;

/**
 * Class UserEntity
 * @package app\common\models
 */
class UserEntity extends base\AbstractUserEntity
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\common\models\UserProfile', 'user_id', ['alias' => 'UserProfile']);
        $this->hasMany('id', 'app\common\models\UserRoles', 'user_id'. ['alias' => 'UserRoles']);
        $this->belongsTo('type_id', 'app\common\models\UserType', 'id', ['alias' => 'UserType']);
    }
}
