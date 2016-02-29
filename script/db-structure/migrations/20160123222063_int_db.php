<?php

use Phinx\Migration\AbstractMigration;

class IntDb extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
     **/
    public function change()
    {
        $contato1 = $this->table('int_db', ['id' => 'id_int_db'***REMOVED***);
        $contato1->addColumn('int_enus', 'integer', ['null' => true***REMOVED***);
        $contato1->addColumn('int_ptbr', 'integer', ['null' => true***REMOVED***);
        $contato1->addColumn('checkbox', 'integer', ['null' => true***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('int_db_req', ['id' => 'id_int_db_req'***REMOVED***);
        $contato2->addColumn('int_enus', 'integer', ['null' => false***REMOVED***);
        $contato2->addColumn('int_ptbr', 'integer', ['null' => false***REMOVED***);
        $contato2->addColumn('checkbox', 'integer', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('int_db_mix', ['id' => 'id_int_db_mix'***REMOVED***);
        $contato3->addColumn('int_enus', 'integer', ['null' => true***REMOVED***);
        $contato3->addColumn('int_ptbr', 'integer', ['null' => true***REMOVED***);
        $contato3->addColumn('checkbox', 'integer', ['null' => true***REMOVED***);
        $contato3->addColumn('int_req_enus', 'integer', ['null' => false***REMOVED***);
        $contato3->addColumn('int_req_ptbr', 'integer', ['null' => false***REMOVED***);
        $contato3->addColumn('checkbox_req', 'integer', ['null' => false***REMOVED***);
        $contato3->create();

        $table = $this->table('int_dep_three', ['id' => 'id_int_dep_three'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();


        $table = $this->table('int_dep_four', ['id' => 'id_int_dep_four'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();

        $table = $this->table('int_dep_two', ['id' => 'id_int_dep_two'***REMOVED***);
        $table->addColumn('id_int_dep_three', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('id_int_dep_four', 'integer', ['null' => true***REMOVED***);
        $table->addForeignKey('id_int_dep_three', 'int_dep_three', 'id_int_dep_three', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->addForeignKey('id_int_dep_four', 'int_dep_four', 'id_int_dep_four', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();

        $table = $this->table('int_dep_one', ['id' => 'id_int_dep_one'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->addColumn('id_int_dep_two', 'integer');
        $table->addForeignKey('id_int_dep_two', 'int_dep_two', 'id_int_dep_two', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->create();





    }
}
