<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 18:51
 */

namespace app\api\transformers;


use app\api\models\Project;
use app\api\models\Task;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
//    public $defaultIncludes = [
//        'tasks'
//    ];

    public function transform(Project $project)
    {
        return [
            'project_id' => (int) $project->project_id,
            'client_id' => (int) $project->client_id,
            'title' => (string) $project->title
        ];
    }

    public function includeTasks(Project $project)
    {
        $tasks = Task::find([
            ['project_id' => $project->project_id]
        ]);

        return $this->collection($tasks, new TaskTransformer());
    }
}