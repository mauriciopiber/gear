<?php

use Phinx\Migration\AbstractMigration;

class DateDb extends AbstractMigration
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
        $contato1 = $this->table('date_db', ['id' => 'id_date_db'***REMOVED***);
        $contato1->addColumn('date_enus', 'date', ['null' => true***REMOVED***);
        $contato1->addColumn('date_ptbr', 'date', ['null' => true***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('date_db_req', ['id' => 'id_date_db_req'***REMOVED***);
        $contato2->addColumn('date_enus', 'date', ['null' => false***REMOVED***);
        $contato2->addColumn('date_ptbr', 'date', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('date_db_mix', ['id' => 'id_date_db_mix'***REMOVED***);
        $contato3->addColumn('date_enus', 'date', ['null' => true***REMOVED***);
        $contato3->addColumn('date_ptbr', 'date', ['null' => true***REMOVED***);
        $contato3->addColumn('date_req_enus', 'date', ['null' => false***REMOVED***);
        $contato3->addColumn('date_req_ptbr', 'date', ['null' => false***REMOVED***);
        $contato3->create();

    }
}
