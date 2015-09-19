<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:20 PM
 */

namespace app\frontend\models;

/**
 * Class UserProfile
 * @package app\frontend\models
 */
class UserProfile extends \app\common\models\UserProfile
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->belongsTo('user_id', 'app\frontend\models\UserEntity', 'id', ['alias' => 'UserEntity']);
    }
}
