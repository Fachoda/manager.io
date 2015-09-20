<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:57 PM
 */

namespace app\frontend\forms\session;
use app\common\components\auth\AuthException;

/**
 * Handles user login
 *
 * Class Login
 * @package app\frontend\forms\session
 */
class Login extends base\LoginBase
{
    public function login()
    {
        if ($this->isValid($this->request->getPost()) === false) {
            foreach ($this->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $this->auth->check([
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'remember_me' => $this->request->getPost('remember_me')
            ]);

            return $this->response->redirect($this->auth->getSuccessUrl());
        }

        return $this->response->redirect($this->auth->getFailUrl());
    }
}
