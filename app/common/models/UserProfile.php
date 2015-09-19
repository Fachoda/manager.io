<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:20 PM
 */

namespace app\common\models;

/**
 * Class UserProfile
 * @package app\common\models
 */
class UserProfile extends base\AbstractUserProfile
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->belongsTo('user_id', 'app\common\models\UserEntity', 'id', ['alias' => 'UserEntity']);
    }
}
