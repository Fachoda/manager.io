<?php

use app\frontend\models\UserEntity;

class UserTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testUserSaveShould()
    {
        $user = new UserEntity();
        $user->setUsername('my username');
        $user->setEmail('mymail@mail.com');
        $user->setPassword('my password');
        $user->setTypeId('1');

        $user->create();

        $this->assertNotNull($user->getId(), 'user should be in database');
    }

}