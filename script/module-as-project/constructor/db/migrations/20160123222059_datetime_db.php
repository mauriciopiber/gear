<?php

use Phinx\Migration\AbstractMigration;

class DateTimeDb extends AbstractMigration
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
        $contato1 = $this->table('datetime_db', ['id' => 'id_datetime_db'***REMOVED***);
        $contato1->addColumn('datetime_enus', 'datetime', ['null' => true***REMOVED***);
        $contato1->addColumn('datetime_ptbr', 'datetime', ['null' => true***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('datetime_db_req', ['id' => 'id_datetime_db_req'***REMOVED***);
        $contato2->addColumn('datetime_enus', 'datetime', ['null' => false***REMOVED***);
        $contato2->addColumn('datetime_ptbr', 'datetime', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('datetime_db_mix', ['id' => 'id_datetime_db_mix'***REMOVED***);
        $contato3->addColumn('datetime_enus', 'datetime', ['null' => true***REMOVED***);
        $contato3->addColumn('datetime_ptbr', 'datetime', ['null' => true***REMOVED***);
        $contato3->addColumn('datetime_req_enus', 'datetime', ['null' => false***REMOVED***);
        $contato3->addColumn('datetime_req_ptbr', 'datetime', ['null' => false***REMOVED***);
        $contato3->create();

    }
}
