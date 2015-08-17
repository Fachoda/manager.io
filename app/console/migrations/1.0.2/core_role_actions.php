<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CoreRoleActionsMigration_102 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'core_role_actions',
            array(
            'columns' => array(
                new Column(
                    'role_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'action_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'role_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('FK_role_actions_role_idx', array('role_id')),
                new Index('FK_role_actions_action_idx', array('action_id'))
            ),
            'references' => array(
                new Reference('FK_role_actions_role', array(
                    'referencedSchema' => 'manager',
                    'referencedTable' => 'core_roles',
                    'columns' => array('role_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('FK_role_actions_action', array(
                    'referencedSchema' => 'manager',
                    'referencedTable' => 'core_actions',
                    'columns' => array('action_id'),
                    'referencedColumns' => array('id')
                ))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
