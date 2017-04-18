
<?php

use Phinx\Migration\AbstractMigration;

class ColumnsDatabase extends AbstractMigration
{
    public function change()
    {
        $entitys =[***REMOVED***;

        $tables = [
            'columns_one' => [
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

        foreach ($tables as $tableName => $columns) {

            $entity = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

            foreach ($columns as $columnName => $type) {
                $entity->addColumn($columnName, $type, ['null' => false***REMOVED***);
            }

            $entitys[***REMOVED*** = $entity;
        }

        foreach ($entitys as $entity) {
            $entity->create();
        }
    }
}