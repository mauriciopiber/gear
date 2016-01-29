<?php

use Phinx\Migration\AbstractMigration;

class Metas extends AbstractMigration
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
        $contato = $this->table('metas', ['id' => 'id_metas'***REMOVED***);
        $contato->addColumn('meta', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('valor', 'text', ['null' => false***REMOVED***);
        $contato->addColumn('prazo', 'datetime', ['null' => false***REMOVED***);
        $contato->create();
    }
}