<?php

use Phinx\Migration\AbstractMigration;

class FullDatabase extends AbstractMigration
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
            'full_one' => [
                'column_varchar' => 'string',
                'column_url' => 'string',
                'column_upload_image' => 'string',
                'column_unique_id' => 'string',
                'column_email' => 'string',
                'column_telephone' => 'string',
                'column_password_verify' => 'string',
                'column_time' => 'time',
                'column_datetime' => 'datetime',
                'column_datetime_ptbr' => 'datetime',
                'column_date' => 'date',
                'column_date_ptbr' => 'date',
                'column_decimal' => 'decimal',
                'column_money' => 'decimal',
                'column_checkbox_int' => 'integer',
                'column_checkbox_tinyint' => 'boolean',
                'column_integer' => 'integer',
                'column_tinyint' => 'boolean',
                //'column_foreign_key' => 'foreignkey',
                'column_text' => 'text',
                'column_html' => 'text'
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