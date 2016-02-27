
<?php

use Phinx\Migration\AbstractMigration;

class VarcharDb extends AbstractMigration
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
        $contato1 = $this->table('varchar_db', ['id' => 'id_varchar_db'***REMOVED***);
        $contato1->addColumn('varchar_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $contato1->addColumn('varchar_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('varchar_db_req', ['id' => 'id_varchar_db_req'***REMOVED***);
        $contato2->addColumn('varchar_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $contato2->addColumn('varchar_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('varchar_db_mix', ['id' => 'id_varchar_db_mix'***REMOVED***);
        $contato3->addColumn('varchar_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $contato3->addColumn('varchar_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $contato3->create();

    }
}