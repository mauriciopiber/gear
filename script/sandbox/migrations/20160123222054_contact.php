<?php

use Phinx\Migration\AbstractMigration;

class Contact extends AbstractMigration
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
        $contato = $this->table('contato', ['id' => 'id_contato'***REMOVED***);
        $contato->addColumn('email', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('assunto', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('mensagem', 'text', ['null' => false***REMOVED***);
        $contato->create();


        $contato = $this->table('mensagem', ['id' => 'id_mensagem'***REMOVED***);
        $contato->addColumn('email_mensagem', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('assunto_mensagem', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('mensagem_da_mensagem', 'text', ['null' => false***REMOVED***);
        $contato->create();

    }
}