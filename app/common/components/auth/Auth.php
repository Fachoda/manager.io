<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/20/2015
 * Time: 12:00 AM
 */

namespace app\common\components\auth;

use app\common\models\UserEntity;
use Phalcon\Mvc\User\Component;

/**
 * Manage Authentication/Identity management in application
 *
 * Class Auth
 * @package app\common\components\auth
 */
class Auth extends Component
{
    const MESSAGE_INVALID_CREDENTIALS = 'Wrong username/password combination';
    const MESSAGE_NOT_FOUND = 'The user does not exist';

    /**
     * the route for login success
     *
     * @var string
     */
    private $successUrl = 'dashboard';

    /**
     * the route for login fail
     *
     * @var string
     */
    private $failUrl = 'session/login';

    /**
     * set the success url
     *
     * @param $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
    }

    /**
     * set the fail url
     *
     * @param $failUrl
     */
    public function setFailUrl($failUrl)
    {
        $this->failUrl = $failUrl;
    }

    /**
     * get the success url
     *
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * get the fail url
     */
    public function getFailUrl()
    {
        return $this->fail;
    }

    /**
     * check the user credentials
     *
     * @param array $credentials
     * @throws AuthException
     */
    public function check($credentials)
    {
        $user = UserEntity::findFirstByUsername($credentials['username']);
        if ($user === false) {
            throw new AuthException(self::MESSAGE_INVALID_CREDENTIALS);
        }

        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            throw new AuthException(self::MESSAGE_INVALID_CREDENTIALS);
        }

        if (isset($credentials['remember_me'])) {
            $this->createRememberMeEnvironment($user);
        }

        $this->session->set('auth-identity', [
            'id'        => $user->getId(),
            'username'  => $user->getUsername()
        ]);
    }

    /**
     * set the remember me cookie
     *
     * @param UserEntity $user
     */
    public function createRememberMeEnvironment(UserEntity $user)
    {
        $userAgent  = $this->request->getUserAgent();
        $token      = $this->security->hash($user->getUsername() . $user->getPassword() . $userAgent);

        //expire in a week
        $expire = time() + 86400 * 7;
        $this->cookies->set('RMU', $user->getId(), $expire);
        $this->cookies->set('RMT', $token, $expire);
    }

    /**
     * Check if the session has remember me
     *
     * @return bool
     */
    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }

    public function loginWithRememberMe()
    {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = UserEntity::findFirstById($userId);
        if ($user) {
            $userAgent = $this->request->getUserAgent();
            $token = $this->security->hash($user->getUsername() . $user->getPassword . $userAgent);

            if ($cookieToken == $token) {
                $this->session->set('auth-identity', [
                    'id'        => $user->getId(),
                    'username'  => $user->getUsername()
                ]);

                return $this->response->redirect($this->successUrl);
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect($this->failUrl);
    }

    /**
     * Get the current identity
     */
    public function getIdentity()
    {
        return $this->session->get('auth-identity', false);
    }

    /**
     * remove the current identity from session
     */
    public function remove()
    {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth-identity');
    }

    /**
     * Authorize the user based on id
     *
     * @param $id
     * @throws AuthException
     */
    public function authById($id)
    {
        $user = $this->getIdentity();
        if ($user === false) {
            throw new AuthException(self::MESSAGE_NOT_FOUND);
        }

        $this->session->set('auth-identity', [
            'id'    => $user->getId(),
            'username'  => $user->getUsername()
        ]);
    }

    /**
     * Get the user based on the session identity
     *
     * @return bool|UserEntity
     * @throws AuthException
     */
    public function getUser()
    {
        $identity = $this->getIdentity();
        if (isset($identity['id'])) {
            $user = UserEntity::findFirstById($identity['id']);
            if ($user === false) {
                throw new AuthException(self::MESSAGE_NOT_FOUND);
            }

            return $user;
        }

        return false;
    }
}
