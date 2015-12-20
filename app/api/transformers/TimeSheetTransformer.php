<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 17:28
 */

namespace app\api\transformers;

use app\api\models\Project;
use app\api\models\Task;
use app\api\models\TimeSheet;
use app\api\models\User;
use League\Fractal\TransformerAbstract;

class TimeSheetTransformer extends TransformerAbstract
{
//    protected $defaultIncludes = [
//        'user', 'project', 'task'
//    ];

    public function transform(TimeSheet $timeSheet)
    {
        return [
            'id' => (string) $timeSheet->getId()->__toString(),
            'user_id' => (int) $timeSheet->user_id,
            'project_id' => (int) $timeSheet->project_id,
            'task_id' => (int) $timeSheet->task_id,
            'duration' => (float) $timeSheet->duration,
            'start_time' => (float) $timeSheet->start_time,
            'description' => (string) $timeSheet->description,
            'billable' => (boolean) $timeSheet->billable,
            'date' => $timeSheet->date,
            'date_added' => $timeSheet->date_added
        ];
    }

    public function includeUser(TimeSheet $timeSheet)
    {
        $user = User::findFirst([
            ['user_id' => $timeSheet->user_id]
        ]);

        return $this->item($user, new UserTransformer());
    }

    public function includeProject(TimeSheet $timeSheet)
    {
        $project = Project::findFirst([
            ['project_id' => $timeSheet->project_id]
        ]);

        return $this->item($project, new ProjectTransformer());
    }

    public function includeTask(TimeSheet $timeSheet)
    {
        $task = Task::findFirst([
            ['task_id' => $timeSheet->task_id]
        ]);

        return $this->item($task, new TaskTransformer());
    }
}