<?php

use Phinx\Migration\AbstractMigration;

/**
 * @SuppressWarnings(PHPMD)
 */
class CreateGearAdmin extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {

        /**
         * User
         */
        $tableUser = $this->table('user', array('id' => 'id_user'));
        $tableUser

          ->addColumn('email', 'string', array('limit' => 100))
          ->addIndex(array('email'), array('unique' => true))

          ->addColumn('password', 'string', array('limit' => 150))
          ->addColumn('username', 'string', array('limit' => 50))
          ->addColumn('state', 'integer')
          ->addColumn('uid', 'string', array('limit' => 50))

          ->addColumn('created', 'datetime', array('null' => true))
          ->addColumn('updated', 'datetime', array('null' => true))

          ->addColumn('created_by', 'integer', array('null' => true))
          ->addForeignKey('created_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))

          ->addColumn('updated_by', 'integer', array('null' => true))
          ->addForeignKey('updated_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))


          ->create();

        /**
         * Role
         */
        $tableRole =  $this->table('role', array('id' => 'id_role'));

        $tableRole


        ->addColumn('id_parent', 'integer', array('null' => true))
        ->addColumn('name', 'string', array('null' => false, 'limit' => 50))
        ->addIndex(array('name'), array('unique' => true));

        $this->setUser($tableRole);
        $tableRole->create();


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

        /**
         * Module
         */
        $tableModule = $this->table('module', array('id' => 'id_module'));

        $tableModule->addColumn('name', 'string', array('limit' => 150, 'null' => false));

        $this->setUser($tableModule);

        $tableModule->create();

        /**
         * Controller
        */
        $tableController = $this->table('controller', array('id' => 'id_controller'));

        $tableController->addColumn('id_module', 'integer', array('null' => false));
        $tableController->addColumn('name', 'string', array('limit' => 150, 'null' => false));
        $tableController->addColumn('invokable', 'string', array('limit' => 150, 'null' => false));
        $tableController->addForeignKey('id_module', 'module', 'id_module', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $this->setUser($tableController);

        $tableController->create();

        /**
         * Action
        */
        $tableAction = $this->table('action', array('id' => 'id_action'));

        $tableAction->addColumn('id_controller', 'integer', array('null' => false));
        $tableAction->addForeignKey('id_controller', 'controller', 'id_controller', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $tableAction->addColumn('name', 'string', array('null' => false));
        $this->setUser($tableAction);

        $tableAction->create();

        /**
         * Rule
        */
        $tableRule = $this->table('rule', array('id' => 'id_rule'));
        $tableRule->addColumn('id_action', 'integer', array('null' => false));
        $tableRule->addForeignKey('id_action', 'action', 'id_action', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $tableRule->addColumn('id_controller', 'integer', array('null' => false));
        $tableRule->addForeignKey('id_controller', 'controller', 'id_controller', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $tableRule->addColumn('id_role', 'integer', array('null' => false));
        $tableRule->addForeignKey('id_role', 'role', 'id_role', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $this->setUser($tableRule);

        $tableRule->create();

        /**
         * Email
        */
        $tableEmail = $this->table('email', array('id' => 'id_email'));
        $tableEmail->addColumn('remetente', 'string', array('null' => false));
        $tableEmail->addColumn('destino', 'string', array('null' => false));
        $tableEmail->addColumn('assunto', 'string', array('null' => false));
        $tableEmail->addColumn('mensagem', 'string', array('null' => false));

        $this->setUser($tableEmail);

        $tableEmail->create();
    }



    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('email');
        $this->dropTable('rule');
        $this->dropTable('action');
        $this->dropTable('controller');
        $this->dropTable('module');
        $this->dropTable('user_role_linker');
        $this->dropTable('role');
        $this->dropTable('user');
    }

    public function setUser(&$table)
    {
        $table->addColumn('created', 'datetime', array('null' => false))
        ->addColumn('created_by', 'integer', array('null' => false))
        ->addForeignKey('created_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))

        ->addColumn('updated', 'datetime', array('null' => true))
        ->addColumn('updated_by', 'integer', array('null' => true))
        ->addForeignKey('updated_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
    }

}