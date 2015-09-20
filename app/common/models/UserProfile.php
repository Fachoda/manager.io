<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:20 PM
 */

namespace app\common\models;
use app\common\models\traits\Timestamp;

/**
 * Class UserProfile
 * @package app\common\models
 */
class UserProfile extends base\AbstractUserProfile
{
    use Timestamp;

    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->belongsTo('user_id', 'app\common\models\UserEntity', 'id', ['alias' => 'UserEntity']);
    }
}
