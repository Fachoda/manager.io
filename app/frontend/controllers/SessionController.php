<?php

/**
 * Session controller
 * Handle user sessions
 */

namespace app\frontend\controllers;

use app\common\components\auth\AuthException;
use app\frontend\forms\session\Login;
use app\frontend\models\UserEntity;

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
        $form = new Login();

        try {
            if (!$this->request->isPost()) {
                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {
                return $form->login();
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Handle user forgot password
     */
    public function forgotPasswordAction()
    {

    }
}