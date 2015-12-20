<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:15
 */

namespace app\api\collections;

use app\api\controllers\UsersController;
use Phalcon\Mvc\Micro\Collection as PhCollection;

class UsersCollection extends PhCollection
{
    public function __construct()
    {
        $this->setHandler(new UsersController());
        $this->setPrefix('users');

        $this->get('/', 'index');
        $this->post('/', 'create');
        $this->put('/{user_id}', 'update');
        $this->get('/{user_id}', 'view');
        $this->delete('/{user_id}', 'delete');
    }
}