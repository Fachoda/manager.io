<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 18:52
 */

namespace app\api\transformers;


use app\api\models\Project;
use app\api\models\Task;
use app\api\models\TimeSheet;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
//    public $availableIncludes = [
//        'project'
//    ];

//    public $defaultIncludes = [
//        'timesheets', 'project'
//    ];

    public function transform(Task $task)
    {
        return [
            'task_id' => (int) $task->task_id,
            'project_id' => (int) $task->project_id,
            'title' => (string) $task->title
        ];
    }

    public function includeTimesheets(Task $task)
    {
        $timesheets = TimeSheet::find([
            ['task_id' => $task->task_id]
        ]);

        return $this->collection($timesheets, new TimeSheetTransformer());
    }

    public function includeProject(Task $task)
    {
        $project = Project::findFirst([
            ['project_id' => $task->project_id]
        ]);

        return $this->item($project, new ProjectTransformer());
    }
}