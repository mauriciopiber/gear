<?php

use Phinx\Migration\AbstractMigration;

class TextDb extends AbstractMigration
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
        $contato1 = $this->table('text_db', ['id' => 'id_text_db'***REMOVED***);
        $contato1->addColumn('text_enus', 'text', ['null' => true***REMOVED***);
        $contato1->addColumn('text_ptbr', 'text', ['null' => true***REMOVED***);
        $contato1->create();

        $contato2 = $this->table('text_db_req', ['id' => 'id_text_db_req'***REMOVED***);
        $contato2->addColumn('text_enus', 'text', ['null' => false***REMOVED***);
        $contato2->addColumn('text_ptbr', 'text', ['null' => false***REMOVED***);
        $contato2->create();

        $contato3 = $this->table('text_db_mix', ['id' => 'id_text_db_mix'***REMOVED***);
        $contato3->addColumn('text_enus', 'text', ['null' => true***REMOVED***);
        $contato3->addColumn('text_ptbr', 'text', ['null' => true***REMOVED***);
        $contato3->addColumn('text_req_enus', 'text', ['null' => false***REMOVED***);
        $contato3->addColumn('text_req_ptbr', 'text', ['null' => false***REMOVED***);
        $contato3->create();

    }
}
