<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:14
 */

namespace app\api\collections;

use app\api\controllers\ProjectsController;
use Phalcon\Mvc\Micro\Collection as PhCollection;

class ProjectsCollection extends PhCollection
{
    public function __construct()
    {
        $this->setHandler(new ProjectsController());
        $this->setPrefix('projects');

        $this->get('/', 'index');
        $this->post('/', 'create');
        $this->put('/{project_id}', 'update');
        $this->get('/{project_id}', 'view');
        $this->delete('/{project_id}', 'delete');
    }
}