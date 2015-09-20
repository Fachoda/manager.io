<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:19 PM
 */

namespace app\common\models;

use app\common\models\traits\Timestamp;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Email;

/**
 * Class UserEntity
 * @package app\common\models
 */
class UserEntity extends base\AbstractUserEntity
{
    use Timestamp;

    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->hasMany('id', 'app\common\models\UserProfile', 'user_id', ['alias' => 'UserProfile']);
        $this->hasMany('id', 'app\common\models\UserRoles', 'user_id', ['alias' => 'UserRoles']);
        $this->belongsTo('type_id', 'app\common\models\UserType', 'id', ['alias' => 'UserType']);
    }

    /**
     * * validate the model before saving
     * ensure username uniqueness
     * ensure email uniqueness
     *
     * @return bool
     */
    public function validation()
    {
        $this->validate(new PresenceOf([
                'field'     => 'username',
                'message'   => 'Please provide an username'
        ]));
        $this->validate(new PresenceOf([
                'field'     => 'email',
                'message'   => 'Please provide an email address'
        ]));
        $this->validate(new Uniqueness([
                'field'     => 'username',
                'message'   => 'Username already taken',
        ]));
        $this->validate(new Uniqueness([
                'field'     => 'email',
                'message'   => 'Email already in use'
        ]));
        $this->validate(new Email([
                'field'     => 'email',
                'message'   => 'Please provide a valid email address'
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }
}
