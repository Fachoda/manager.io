<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 20:05
 */

namespace app\api\controllers;


use app\api\models\Project;
use app\api\transformers\ProjectTransformer;
use PhalconRest\Exceptions\Exception;

class ProjectsController extends ControllerBase
{
    public function index()
    {
        $projects = Project::find();

        return $this->respondCollection($projects, new ProjectTransformer(), 'projects');
    }

    public function view($project_id)
    {
        $project = Project::findFirst([
            ['project_id' => $project_id]
        ]);

        return $this->respondItem($project, new ProjectTransformer(), 'project');
    }

    public function create()
    {
        $data = $this->request->getJsonRawBody();

        $project = new Project();
        $project->assign((array) $data);

        if (!$project->save()) {
            throw new Exception('Could not save project');
        }

        return $this->respondItem($project, new ProjectTransformer(), 'project');
    }

    public function update($project_id)
    {
        $data = $this->request->getJsonRawBody();

        /**
         * @var $project Project
         */
        $project = Project::findById($project_id);
        $project->assign((array) $data);

        if (!$project->save()) {
            throw new Exception('Could not save project');
        }

        return $this->respondItem($project, new ProjectTransformer(), 'project');
    }

    public function delete($project_id)
    {
        $project = Project::findById($project_id);

        if (!$project->delete()) {
            throw new Exception('Could not delete the project');
        }

        return $this->respondOK();
    }
}