<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:05
 */

namespace app\api\controllers;


use app\api\models\User;
use app\api\transformers\UserTransformer;
use PhalconRest\Exceptions\Exception;

class UsersController extends ControllerBase
{
    public function index()
    {
        $users = User::find();

        return $this->respondCollection($users, new UserTransformer(), 'users');
    }

    public function view($user_id)
    {
        $user = User::findFirst([
            ['user_id' => $user_id]
        ]);

        return $this->respondItem($user, new UserTransformer(), 'user');
    }

    public function create()
    {
        $data = $this->request->getJsonRawBody();

        $user = new User();
        $user->assign((array) $data);

        if (!$user->save()) {
            throw new Exception('Could not save project');
        }

        return $this->respondItem($user, new UserTransformer(), 'user');
    }

    public function update($user_id)
    {
        $data = $this->request->getJsonRawBody();

        /**
         * @var $user user
         */
        $user = User::findById($user_id);
        $user->assign((array) $data);

        if (!$user->save()) {
            throw new Exception('Could not save project');
        }

        return $this->respondItem($user, new UserTransformer(), 'user');
    }

    public function delete($user_id)
    {
        $user = User::findById($user_id);

        if (!$user->delete()) {
            throw new Exception('Could not delete the user');
        }

        return $this->respondOK();
    }
}