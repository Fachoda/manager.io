<?php

/**
 * Session controller
 * Handle user sessions
 */

namespace app\frontend\controllers;

class SessionController extends ControllerBase
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        parent::initialize();
        $this->view->setMainView('session');
    }

    /**
     * Handle user signup
     */
    public function signupAction()
    {

    }

    /**
     * Handle user account confirmation
     */
    public function confirmAction()
    {

    }

    /**
     * Handle user login
     */
    public function loginAction()
    {

    }

    /**
     * Handle user forgot password
     */
    public function forgotPasswordAction()
    {

    }
}