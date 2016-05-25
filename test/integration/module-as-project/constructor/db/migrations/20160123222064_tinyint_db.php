<?php

use Phinx\Migration\AbstractMigration;

class TinyintDb extends AbstractMigration
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
        $contato1 = $this->table('tinyint_db', ['id' => 'id_tinyint_db'***REMOVED***);
        $contato1->addColumn('tinyint_enus', 'boolean', ['null' => true***REMOVED***);
        $contato1->addColumn('tinyint_ptbr', 'boolean', ['null' => true***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('tinyint_db_req', ['id' => 'id_tinyint_db_req'***REMOVED***);
        $contato2->addColumn('tinyint_enus', 'boolean', ['null' => false***REMOVED***);
        $contato2->addColumn('tinyint_ptbr', 'boolean', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('tinyint_db_mix', ['id' => 'id_tinyint_db_mix'***REMOVED***);
        $contato3->addColumn('tinyint_enus', 'boolean', ['null' => true***REMOVED***);
        $contato3->addColumn('tinyint_ptbr', 'boolean', ['null' => true***REMOVED***);
        $contato3->addColumn('tinyint_req_enus', 'boolean', ['null' => false***REMOVED***);
        $contato3->addColumn('tinyint_req_ptbr', 'boolean', ['null' => false***REMOVED***);
        $contato3->create();

    }
}
