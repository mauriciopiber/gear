
<?php

use Phinx\Migration\AbstractMigration;

class AllColumns extends AbstractMigration
{
    const TABLES = [
        'int_foreign_key' => [
            'nullable' => false,
            'unique' => false,
            'tables' => [***REMOVED***,
            'columns' => [
                'dep_name' => ['type' => 'string'***REMOVED***
            ***REMOVED***,
        ***REMOVED***,
        'all_columns_db' => [
            'nullable' => false,
            'unique' => false,
            'tables' => ['upload_image'***REMOVED***,
            'columns' => [
                'varchar_password_verify' => ['type' => 'string'***REMOVED***,
                'varchar_upload_image' => ['type' => 'string'***REMOVED***,
                'varchar_url' => ['type' => 'string'***REMOVED***,
                'varchar_varchar' => ['type' => 'string'***REMOVED***,
                'varchar_unique_id' => ['type' => 'string'***REMOVED***,
                'varchar_telephone' => ['type' => 'string'***REMOVED***,
                'varchar_email' => ['type' => 'string'***REMOVED***,
                'boolean_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_checkbox' => ['type' => 'boolean'***REMOVED***,
                'int_int' => ['type' => 'integer'***REMOVED***,
                'int_checkbox' => ['type' => 'integer'***REMOVED***,
                'id_int_foreign_key' => ['type' => 'integer', 'properties' => ['foreignKey'***REMOVED******REMOVED***,
                'time_time' => ['type' => 'time'***REMOVED***,
                'text_text' => ['type' => 'text'***REMOVED***,
                'text_html' => ['type' => 'text'***REMOVED***,
                'decimal_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_money_pt_br' => ['type' => 'decimal'***REMOVED***,
                'datetime_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_datetime_pt_br' => ['type' => 'datetime'***REMOVED***,
                'date_date' => ['type' => 'date'***REMOVED***,
                'date_date_pt_br' => ['type' => 'date'***REMOVED***
            ***REMOVED***,
        ***REMOVED***,
        'all_columns_db_nn' => [
            'nullable' => true,
            'unique' => false,
            'columns' => [
                'varchar_nn_password_verify' => ['type' => 'string'***REMOVED***,
                'varchar_nn_upload_image' => ['type' => 'string'***REMOVED***,
                'varchar_nn_url' => ['type' => 'string'***REMOVED***,
                'varchar_nn_varchar' => ['type' => 'string'***REMOVED***,
                'varchar_nn_unique_id' => ['type' => 'string'***REMOVED***,
                'varchar_nn_telephone' => ['type' => 'string'***REMOVED***,
                'varchar_nn_email' => ['type' => 'string'***REMOVED***,
                'boolean_nn_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_nn_checkbox' => ['type' => 'boolean'***REMOVED***,
                'int_nn_int' => ['type' => 'integer'***REMOVED***,
                'int_nn_checkbox' => ['type' => 'integer'***REMOVED***,
                'id_int_nn_foreign_key' => ['type' => 'integer', 'properties' => ['foreignKey'***REMOVED******REMOVED***,
                'time_nn_time' => ['type' => 'time'***REMOVED***,
                'text_nn_text' => ['type' => 'text'***REMOVED***,
                'text_nn_html' => ['type' => 'text'***REMOVED***,
                'decimal_nn_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_nn_money_pt_br' => ['type' => 'decimal'***REMOVED***,
                'datetime_nn_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_nn_datetime_pt_br' => ['type' => 'datetime'***REMOVED***,
                'date_nn_date' => ['type' => 'date'***REMOVED***,
                'date_nn_date_pt_br' => ['type' => 'date'***REMOVED***
            ***REMOVED***,
        ***REMOVED***,
        'all_columns_db_un' => [
            'nullable' => false,
            'unique' => true,
            'tables' => [***REMOVED***,
            'columns' => [
                'varchar_un_password_verify' => ['type' => 'string'***REMOVED***,
                'varchar_un_upload_image' => ['type' => 'string'***REMOVED***,
                'varchar_un_url' => ['type' => 'string'***REMOVED***,
                'varchar_un_varchar' => ['type' => 'string'***REMOVED***,
                'varchar_un_unique_id' => ['type' => 'string'***REMOVED***,
                'varchar_un_telephone' => ['type' => 'string'***REMOVED***,
                'varchar_un_email' => ['type' => 'string'***REMOVED***,
                'boolean_un_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_un_checkbox' => ['type' => 'boolean'***REMOVED***,
                'int_un_int' => ['type' => 'integer'***REMOVED***,
                'int_un_checkbox' => ['type' => 'integer'***REMOVED***,
                'id_int_un_foreign_key' => ['type' => 'integer', 'properties' => ['foreignKey'***REMOVED******REMOVED***,
                'time_un_time' => ['type' => 'time'***REMOVED***,
                'text_un_text' => ['type' => 'text'***REMOVED***,
                'text_un_html' => ['type' => 'text'***REMOVED***,
                'decimal_un_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_un_money_pt_br' => ['type' => 'decimal'***REMOVED***,
                'datetime_un_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_un_datetime_pt_br' => ['type' => 'datetime'***REMOVED***,
                'date_un_date' => ['type' => 'date'***REMOVED***,
                'date_un_date_pt_br' => ['type' => 'date'***REMOVED***
            ***REMOVED***,
        ***REMOVED***,
        'all_columns_db_un_nn' => [
            'nullable' => true,
            'unique' => true,
            'tables' => [***REMOVED***,
            'columns' => [
                'varchar_un_nn_password_verify' => ['type' => 'string'***REMOVED***,
                'varchar_un_nn_upload_image' => ['type' => 'string'***REMOVED***,
                'varchar_un_nn_url' => ['type' => 'string'***REMOVED***,
                'varchar_un_nn_varchar' => ['type' => 'string'***REMOVED***,
                'varchar_un_nn_unique_id' => ['type' => 'string'***REMOVED***,
                'varchar_un_nn_telephone' => ['type' => 'string'***REMOVED***,
                'varchar_un_nn_email' => ['type' => 'string'***REMOVED***,
                'boolean_un_nn_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_un_nn_checkbox' => ['type' => 'boolean'***REMOVED***,
                'int_un_nn_int' => ['type' => 'integer'***REMOVED***,
                'int_un_nn_checkbox' => ['type' => 'integer'***REMOVED***,
                'id_int_un_nn_foreign_key' => ['type' => 'integer', 'properties' => ['foreignKey'***REMOVED******REMOVED***,
                'time_un_nn_time' => ['type' => 'time'***REMOVED***,
                'text_un_nn_text' => ['type' => 'text'***REMOVED***,
                'text_un_nn_html' => ['type' => 'text'***REMOVED***,
                'decimal_un_nn_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_un_nn_money_pt_br' => ['type' => 'decimal'***REMOVED***,
                'datetime_un_nn_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_un_nn_datetime_pt_br' => ['type' => 'datetime'***REMOVED***,
                'date_un_nn_date' => ['type' => 'date'***REMOVED***,
                'date_un_nn_date_pt_br' => ['type' => 'date'***REMOVED***
            ***REMOVED***,
        ***REMOVED***
    ***REMOVED***;

    public function createUnique(&$table, $columnName, $type)
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

    public function createColumn(&$table, $tableName, $columnName, $type, $nullable, $unique, $properties)
    {
         $table->addColumn($columnName, $type, $this->getColumnConfig($type, $nullable));

         if ($unique && !in_array($type, ['text', 'boolean'***REMOVED***)) {
             $this->createUnique($table, $columnName, $type);
         }

         return true;

    }

    public function createTable($tableName, $options)
    {
        $table = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

        foreach ($options['columns'***REMOVED*** as $columnName => $column) {
            $nullable = (isset($column['nullable'***REMOVED***)) ? $column['nullable'***REMOVED*** : $options['nullable'***REMOVED***;
            $unique = (isset($column['unique'***REMOVED***)) ? $column['unique'***REMOVED*** : $options['unique'***REMOVED***;
            $properties = (isset($column['properties'***REMOVED***)) ? $column['properties'***REMOVED*** : [***REMOVED***;
            $this->createColumn($table, $tableName, $columnName, $column['type'***REMOVED***, $nullable, $unique, $properties);
        }

        $table->create();

        if (isset($options['table'***REMOVED***)) {
            $this->createTableDependencies($tableName, $options['table'***REMOVED***);
        }

    }

    public function createTableDependencies($tableName, $tables)
    {
        if (!isset($options['table'***REMOVED***) && empty($options['table'***REMOVED***) && !is_array($options['table'***REMOVED***)) {
            return;
        }

        foreach ($options['table'***REMOVED*** as $tableOption) {

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