<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 07.12.2015
 * Time: 20:26
 */

namespace app\core\controllers;

use app\core\models\People;
use app\pm\controllers\ControllerBase;

class PeopleController extends ControllerBase
{
    public function indexAction()
    {
        $people = People::find();
        var_dump(count($people));
        var_dump($people);
        die('da');
    }

    public function createAction()
    {
        $model = new People();
        $model->assign([
            'id' => 3,
            'first_name' => '',
            'last_name' => ''
        ]);

        if (!$model->save()) {
            foreach ($model->getMessages() as $message) {
                echo $message . PHP_EOL;
            }
        }
        die();
    }

    public function updateAction($id = null)
    {

    }

    public function deleteAction($id = null)
    {

    }

    public function viewAction($id = null)
    {
        $people = People::find([['last_name' => 'Eavaz']]);
        var_dump($people);
    }
}