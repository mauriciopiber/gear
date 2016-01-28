<?php

use Phinx\Migration\AbstractMigration;

class ImageEntity extends AbstractMigration
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
        $contato = $this->table('all_images_entities', ['id' => 'id_all_images_entities'***REMOVED***);
        $contato->addColumn('mensagem', 'string', ['null' => false***REMOVED***);
        $contato->addColumn('comprometimento', 'string', ['null' => false***REMOVED***);
        $contato->create();

        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_images_entities', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_images_entities', 'all_images_entities', 'id_all_images_entities', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();

    }
}