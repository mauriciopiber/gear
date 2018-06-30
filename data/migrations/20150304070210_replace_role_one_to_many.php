<?php

use Phinx\Migration\AbstractMigration;

/**
 * @SuppressWarnings(PHPMD)
 */
class ReplaceRoleOneToMany extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */

    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->dropTable('user_role_linker');

        $tableUser = $this->table('user');
        $tableUser

        ->addColumn('id_role', 'integer', array('null' => true))
        ->addForeignKey('id_role', 'role', 'id_role', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
        ->save();


        $tableRole = $this->table('role');
        $tableRole
        ->addForeignKey('id_parent', 'role', 'id_role', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
        ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

        $tableUser = $this->table('user');
        $tableUser->dropForeignKey('id_role');
        $tableUser->removeColumn('id_role');

        /**
         * UserRoleLinker
         */
        $tableUserRoleLinker =  $this->table('user_role_linker', array('id' => false, 'primary_key' => array('id_role', 'id_user')));

        $tableUserRoleLinker
        ->addColumn('id_user', 'integer', array('null' => false))
        ->addColumn('id_role', 'integer', array('null' => false))
        ->addForeignKey('id_user', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
        ->addForeignKey('id_role', 'role', 'id_role', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $tableUserRoleLinker->create();


    }
}