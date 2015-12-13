<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 13.12.2015
 * Time: 16:39
 */

namespace app\pm\forms\timesheet;

use app\common\forms\BaseForm;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class BaseTimeSheetForm extends BaseForm
{
    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var integer
     */
    public $project_id;

    /**
     * @var integer
     */
    public $task_id;

    /**
     * @var string
     */
    public $date;

    /**
     * @var float
     */
    public $duration;

    /**
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    protected $bindElements = [
        'user_id',
        'project_id',
        'task_id',
        'date',
        'duration',
        'description'
    ];

    protected function bindUserId()
    {
        $user_id = new Hidden('user_id');

        $user_id->addValidator(new PresenceOf([
            'message' => 'The user id is required to fill in this form'
        ]));
        $user_id->addValidator(new Numeric([
            'message' => 'The user id must be numeric'
        ]));

        $this->user_id = $user_id;

        return $user_id;
    }

    protected function bindProjectId()
    {
        $project_id = new Hidden('project_id');

        $project_id->addValidator(new PresenceOf([
            'message' => 'The project id is required to fill in this form'
        ]));
        $project_id->addValidator(new Numeric([
            'message' => 'The project id must be numeric'
        ]));

        $this->project_id = $project_id;

        return $project_id;
    }

    protected function bindTaskId()
    {
        $task_id = new Hidden('task_id');

        $task_id->addValidator(new PresenceOf([
            'message' => 'The task id is required to fill in this form'
        ]));
        $task_id->addValidator(new Numericality([
            'message' => 'The task id must be numeric'
        ]));

        $this->task_id = $task_id;

        return $task_id;
    }

    protected function bindDate()
    {
        $date = new Date('date');

        $date->addValidator(new PresenceOf([
            'message' => 'Please fill in the date of the event'
        ]));

        $this->date = $date;

        return $date;
    }

    protected function bindDuration()
    {
        $duration = new Numeric('duration');

        $duration->addValidator(new PresenceOf([
            'message' => 'Please fill in the duration'
        ]));

        $duration->addValidator(new Numericality([
            'message' => 'The duration must be a number'
        ]));

        $this->duration = $duration;

        return $duration;
    }

    protected function bindDescription()
    {
        $description = new TextArea('description');

        $description->addValidator(new PresenceOf([
            'message' => 'Please add a description'
        ]));
        $description->addValidator(new StringLength([
            'max'       => 160,
            'min'       => 4,
            'messageMaximum' => 'Please be short with your words',
            'messageMinimum' => 'We want more than 2 letters'
        ]));

        $this->description = $description;

        return $description;
    }
}