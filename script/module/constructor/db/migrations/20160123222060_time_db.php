<?php

use Phinx\Migration\AbstractMigration;

class TimeDb extends AbstractMigration
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
        $contato1 = $this->table('time_db', ['id' => 'id_time_db'***REMOVED***);
        $contato1->addColumn('time_enus', 'time', ['null' => true***REMOVED***);
        $contato1->addColumn('time_ptbr', 'time', ['null' => true***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('time_db_req', ['id' => 'id_time_db_req'***REMOVED***);
        $contato2->addColumn('time_enus', 'time', ['null' => false***REMOVED***);
        $contato2->addColumn('time_ptbr', 'time', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('time_db_mix', ['id' => 'id_time_db_mix'***REMOVED***);
        $contato3->addColumn('time_enus', 'time', ['null' => true***REMOVED***);
        $contato3->addColumn('time_ptbr', 'time', ['null' => true***REMOVED***);
        $contato3->addColumn('time_req_enus', 'time', ['null' => false***REMOVED***);
        $contato3->addColumn('time_req_ptbr', 'time', ['null' => false***REMOVED***);
        $contato3->create();

    }
}
