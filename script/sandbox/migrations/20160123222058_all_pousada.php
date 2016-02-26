<?php

use Phinx\Migration\AbstractMigration;

class AllPousada extends AbstractMigration
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
        $contato = $this->table('columns_pousada', ['id' => 'id_columns_pousada'***REMOVED***);
        $contato->addColumn('email', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('assunto', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('telefone_one', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('telefone_two', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('url_one', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('url_two', 'string', ['null' => false, 'limit' => '100'***REMOVED***);

        $contato->create();


    }
}