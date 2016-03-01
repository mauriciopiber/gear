
<?php

use Phinx\Migration\AbstractMigration;

class UploadImageDb extends AbstractMigration
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
        $contato = $this->table('table_upload_image', ['id' => 'id_table_upload_image'***REMOVED***);
        $contato->addColumn('varchar_upload_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $contato->addColumn('varchar_upload_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);

        $contato->create();

        $contato = $this->table('table_upload_image_req', ['id' => 'id_table_upload_image_req'***REMOVED***);
        $contato->addColumn('varchar_upload_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $contato->addColumn('varchar_upload_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);

        $contato->create();



        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_table_upload_image', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_table_upload_image', 'table_upload_image', 'id_table_upload_image', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->addColumn('id_table_upload_image_req', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_table_upload_image_req', 'table_upload_image_req', 'id_table_upload_image_req', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();

    }
}