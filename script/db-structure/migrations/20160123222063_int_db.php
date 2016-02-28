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
        $contato1->create();

        $contato2 = $this->table('int_db_req', ['id' => 'id_int_db_req'***REMOVED***);
        $contato2->addColumn('int_enus', 'integer', ['null' => false***REMOVED***);
        $contato2->addColumn('int_ptbr', 'integer', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('int_db_mix', ['id' => 'id_int_db_mix'***REMOVED***);
        $contato3->addColumn('int_enus', 'integer', ['null' => true***REMOVED***);
        $contato3->addColumn('int_ptbr', 'integer', ['null' => true***REMOVED***);
        $contato3->addColumn('int_req_enus', 'integer', ['null' => false***REMOVED***);
        $contato3->addColumn('int_req_ptbr', 'integer', ['null' => false***REMOVED***);
        $contato3->create();

    }
}
