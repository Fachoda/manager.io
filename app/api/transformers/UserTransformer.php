<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 18:48
 */

namespace app\api\transformers;

use app\api\models\TimeSheet;
use app\api\models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
//    public $defaultIncludes = [
//        'timesheets'
//    ];

    public function transform(User $user)
    {
        return [
            'user_id' => (int) $user->user_id,
            'first_name' => (string) $user->first_name,
            'last_name' => (string) $user->last_name
        ];
    }

    public function includeTimesheets(User $user)
    {
        $timesheets = TimeSheet::find([
            ['user_id' => $user->user_id]
        ]);

        return $this->collection($timesheets, new TimeSheetTransformer());
    }
}