<?php

use Phinx\Migration\AbstractMigration;

class UploadImageDatabase extends AbstractMigration
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
        $entitys =[***REMOVED***;

        $tables = [
            'upload_image_one' => [
                'column_varchar' => 'string',
            ***REMOVED***,
        ***REMOVED***;

        $update = [***REMOVED***;

        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);

        foreach ($tables as $tableName => $columns) {

            $entity = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

            foreach ($columns as $columnName => $type) {
                $entity->addColumn($columnName, $type, ['null' => false***REMOVED***);
            }

            $entitys[***REMOVED*** = $entity;

            $imageupload->addColumn(sprintf('id_%s', $tableName), 'integer', ['null' => true***REMOVED***);
            $imageupload->addForeignKey(sprintf('id_%s', $tableName), $tableName, sprintf('id_%s', $tableName), ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);
        }

        foreach ($entitys as $entity) {
            $entity->create();
        }

        $imageupload->update();
    }
}