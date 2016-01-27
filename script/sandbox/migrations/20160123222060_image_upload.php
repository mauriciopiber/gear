<?php

use Phinx\Migration\AbstractMigration;

class ImageUpload extends AbstractMigration
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
        $contato = $this->table('all_images_upload', ['id' => 'id_all_images_upload'***REMOVED***);
        $contato->addColumn('varchar_upload_one', 'string', ['null' => true, 'limit' => '200'***REMOVED***);
        $contato->addColumn('varchar_upload_two', 'string', ['null' => true, 'limit' => '200'***REMOVED***);
        $contato->addColumn('mensagem', 'text', ['null' => false***REMOVED***);
        $contato->create();
    }
}