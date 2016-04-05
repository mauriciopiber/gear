<?php

use Phinx\Migration\AbstractMigration;

class DecimalDb extends AbstractMigration
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
        $contato1 = $this->table('decimal_db', ['id' => 'id_decimal_db'***REMOVED***);
        $contato1->addColumn('decimal_enus', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato1->addColumn('decimal_ptbr', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('decimal_db_req', ['id' => 'id_decimal_db_req'***REMOVED***);
        $contato2->addColumn('decimal_enus', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato2->addColumn('decimal_ptbr', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('decimal_db_mix', ['id' => 'id_decimal_db_mix'***REMOVED***);
        $contato3->addColumn('decimal_enus', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato3->addColumn('decimal_ptbr', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato3->addColumn('decimal_req_enus', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato3->addColumn('decimal_req_ptbr', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $contato3->create();

    }
}
