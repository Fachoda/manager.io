<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:19 PM
 */

namespace app\frontend\models;

/**
 * Class UserEntity
 * @package app\frontend\models
 */
class UserEntity extends \app\common\models\UserEntity
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\frontend\models\UserProfile', 'user_id', ['alias' => 'UserProfile']);
        $this->hasMany('id', 'app\frontend\models\UserRoles', 'user_id', ['alias' => 'UserRoles']);
        $this->belongsTo('type_id', 'app\frontend\models\UserType', 'id', ['alias' => 'UserType']);
    }
}
