<?php

use Phinx\Migration\AbstractMigration;

class Image extends AbstractMigration
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
        $contato = $this->table('all_images', ['id' => 'id_all_images'***REMOVED***);
        $contato->addColumn('varchar_upload_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $contato->addColumn('varchar_upload_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $contato->addColumn('mensagem', 'text', ['null' => false***REMOVED***);
        $contato->create();


        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_images', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_images', 'all_images', 'id_all_images', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();

    }
}