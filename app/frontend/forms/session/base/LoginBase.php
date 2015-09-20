<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 11:26 PM
 */

namespace app\frontend\forms\session\base;

use app\frontend\forms\AbstractForm;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Base login form
 * Provides login form attributes and form fields
 *
 * Class LoginBase
 * @package app\frontend\forms\session
 */
class LoginBase extends AbstractForm
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var
     */
    public $remember_me;

    /**
     * attach the elements to the form
     */
    public function initialize()
    {
        $this->getFormElements();
        $this->attachFormElements();
    }

    /*******************************************
     *
     *
     * When extending the methods below make sure
     * to attach the fields to the formElements attribute
     *
     *
     ******************************************/

    public function getFormElements()
    {
        $this->attachUsername();
        $this->attachPassword();
        $this->attachRememberMe();
        $this->attachSubmitButton();
    }

    /**
     * attach the username field with validators
     */
    protected function attachUsername()
    {
        $username = new Text('username');

        $username->addValidator(new PresenceOf([
            'message'   => 'The username is required'
        ]));

        $this->username = $username;
        $this->formElements['username'] = $username;
    }

    /**
     * attach the password field with validators
     */
    protected function attachPassword()
    {
        $password = new Password('password');

        $password->addValidator(new PresenceOf([
            'message'   => 'The password is required'
        ]));

        $password->clear();

        $this->password = $password;
        $this->formElements['password'] = $password;
    }

    /**
     * attach the remember me field with validators
     */
    protected function attachRememberMe()
    {
        $remember_me = new Check('remember_me', [
            'value' => 'yes'
        ]);

        $this->remember_me = $remember_me;
        $this->formElements['remember_me'] = $remember_me;
    }

    /**
     * attach submit button
     */
    protected function attachSubmitButton()
    {
        $submit = new Submit('login');

        $this->formElements['submit'] = $submit;
    }
}
