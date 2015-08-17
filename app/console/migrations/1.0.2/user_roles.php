<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class UserRolesMigration_102 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'user_roles',
            array(
            'columns' => array(
                new Column(
                    'user_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'role_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'user_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('FK_user_role_user_idx', array('user_id')),
                new Index('FK_user_role_role_idx', array('role_id'))
            ),
            'references' => array(
                new Reference('FK_user_role_user', array(
                    'referencedSchema' => 'manager',
                    'referencedTable' => 'user_entity',
                    'columns' => array('user_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('FK_user_role_role', array(
                    'referencedSchema' => 'manager',
                    'referencedTable' => 'core_roles',
                    'columns' => array('role_id'),
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
