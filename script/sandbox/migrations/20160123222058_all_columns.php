<?php

use Phinx\Migration\AbstractMigration;

class AllColumns extends AbstractMigration
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
        $contato = $this->table('all_columns_names', ['id' => 'id_all_columns_names'***REMOVED***);
        $contato->addColumn('varchar_upload_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $contato->addColumn('varchar_upload_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $contato->addColumn('mensagem_date', 'text', ['null' => false***REMOVED***);
        $contato->addColumn('date_enus', 'date', ['null' => false***REMOVED***);
        $contato->addColumn('date_ptbr', 'date', ['null' => false***REMOVED***);
        $contato->addColumn('datetime_enus', 'datetime', ['null' => false***REMOVED***);
        $contato->addColumn('datetime_ptbr', 'datetime', ['null' => false***REMOVED***);
        $contato->addColumn('time', 'time', ['null' => false***REMOVED***);
        $contato->addColumn('data_nome', 'text', ['null' => false***REMOVED***);
        $contato->addColumn('date_enus_required', 'date', ['null' => true***REMOVED***);
        $contato->addColumn('date_ptbr_required', 'date', ['null' => true***REMOVED***);
        $contato->addColumn('datetime_enus_required', 'datetime', ['null' => true***REMOVED***);
        $contato->addColumn('datetime_ptbr_required', 'datetime', ['null' => true***REMOVED***);
        $contato->addColumn('time_required', 'time', ['null' => true***REMOVED***);
        $contato->addColumn('data_nome_required', 'text', ['null' => true***REMOVED***);
        $contato->addColumn('email', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('assunto', 'string', ['null' => false, 'limit' => '100'***REMOVED***);
        $contato->addColumn('mensagem', 'text', ['null' => false***REMOVED***);
        $contato->addColumn('email_mensagem', 'string', ['null' => true, 'limit' => '100'***REMOVED***);
        $contato->addColumn('assunto_mensagem', 'string', ['null' => true, 'limit' => '100'***REMOVED***);
        $contato->addColumn('mensagem_da_mensagem', 'text', ['null' => true***REMOVED***);
        $contato->create();



        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_columns_names', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_columns_names', 'all_columns_names', 'id_all_columns_names', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();

    }
}