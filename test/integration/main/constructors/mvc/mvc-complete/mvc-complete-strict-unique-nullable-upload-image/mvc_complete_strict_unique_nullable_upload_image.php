<?php

use Phinx\Migration\AbstractMigration;

class MvcCompleteStrictUniqueNullableUploadImage extends AbstractMigration
{
    const TABLES = [
        'mvc_complete_strict_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'column_int_foreign' => [
            'nullable' => true,
            'unique' => false,
            'columns' => [
                'column_int_foreign_name' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***,
            'table' => [

            ***REMOVED***
        ***REMOVED***
    ***REMOVED***;

    public function createUnique(&$table, $columnName)
    {
        $table->addIndex($columnName, ['unique' => true***REMOVED***);
    }

    public function createForeignKey(&$table, $columnName)
    {
        $tableName = str_replace('id_', '', $columnName);
        $table->addForeignKey($columnName, $tableName, $columnName, ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);
    }

    public function getColumnConfig($type, $nullable)
    {
        $config = [***REMOVED***;


        switch ($type) {
            case 'string':
                $config = ['null' => $nullable, 'limit' => 150***REMOVED***;
                break;
            case 'text':
                $config = ['null' => $nullable***REMOVED***;
                break;
            case 'decimal':
                $config = ['null' => $nullable, 'precision' => 10, 'scale' => 2***REMOVED***;
                break;
            default:
                $config = ['null' => $nullable***REMOVED***;
                break;
        }

        return $config;
    }

    public function createColumn(&$table, $columnName, $type, $nullable, $unique)
    {
         $table->addColumn($columnName, $type, $this->getColumnConfig($type, $nullable));

        if ($unique && !in_array($type, ['text', 'boolean'***REMOVED***)) {
            $this->createUnique($table, $columnName);
        }

         return true;
    }

    public function createTable($tableName, $options)
    {
        $table = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

        foreach ($options['columns'***REMOVED*** as $columnName => $column) {
            $nullable = (isset($column['nullable'***REMOVED***)) ? $column['nullable'***REMOVED*** : $options['nullable'***REMOVED***;
            $unique = (isset($column['unique'***REMOVED***)) ? $column['unique'***REMOVED*** : $options['unique'***REMOVED***;
            //$properties = (isset($column['properties'***REMOVED***)) ? $column['properties'***REMOVED*** : [***REMOVED***;
            $this->createColumn($table, $columnName, $column['type'***REMOVED***, $nullable, $unique);
        }

        $table->create();

        if (isset($options['referenced_assoc'***REMOVED***)) {
            $this->createTableDependencies($tableName, $options['referenced_assoc'***REMOVED***);
        }
    }

    public function createTableDependencies($tableName, $tables)
    {
        if (empty($tables) || !is_array($tables)) {
            return;
        }

        foreach ($tables as $tableOption) {
            $this->createTableDependency($tableName, $tableOption);
        }
    }

    public function createTableDependency($tableName, $tableOption)
    {
        $tableOptionId = sprintf('id_%s', $tableOption);
        $tableId = sprintf('id_%s', $tableName);

        $referencedTable = $this->table($tableOption, ['id' => $tableOptionId***REMOVED***);
        $referencedTable->addColumn($tableId, 'integer', ['null' => true***REMOVED***);
        $referencedTable->addForeignKey($tableId, $tableName, $tableId, ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);

        $referencedTable->update();
    }

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
        foreach (self::TABLES as $tableName => $options) {
            $this->createTable($tableName, $options);
        }
    }
}