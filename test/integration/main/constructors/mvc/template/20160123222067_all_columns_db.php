
<?php

use Phinx\Migration\AbstractMigration;

class AllColumnsDb extends AbstractMigration
{
    const TABLES = [
        'int_foreign_key' => [
            'nullable' => false,
            'unique' => false,
            'tables' => [***REMOVED***,
            'columns' => [
                'dep_name' => ['type' => 'string'***REMOVED***
            ***REMOVED***,

        ***REMOVED***
        'all_columns_db' => [
            'nullable' => false,
            'unique' => false
            'tables' => ['upload_image'***REMOVED***,
            'columns' => [
                'varchar_password_verify' => ['type' => 'string'***REMOVED***,
                'varchar_upload_image' => ['type' => 'string'***REMOVED***,
                'varchar_url' => ['type' => 'string'***REMOVED***,
                'varchar_varchar' => ['type' => 'string'***REMOVED***,
                'varchar_unique_id' => ['type' => 'string'***REMOVED***,
                'varchar_telephone' => ['type' => 'string'***REMOVED***,
                'varchar_email' => ['type' => 'string'***REMOVED***
                'boolean_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_checkbox' => ['type' => 'boolean'***REMOVED***
                'int_int' => ['type' => 'int'***REMOVED***,
                'int_checkbox' => ['type' => 'int'***REMOVED***,
                'id_int_foreign_key' => ['type' => 'int', 'properties' => ['foreignKey'***REMOVED******REMOVED***
                'time_time' => ['type' => 'time'***REMOVED***
                'text_text' => ['type' => 'text'***REMOVED***,
                'text_html' => ['type' => 'text'***REMOVED***
                'decimal_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_money_pt_br' => ['type' => 'decimal'***REMOVED***
                'datetime_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_datetime_pt_br' => ['type' => 'datetime'***REMOVED***
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
                'varchar_nn_email' => ['type' => 'string'***REMOVED***
                'boolean_nn_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_nn_checkbox' => ['type' => 'boolean'***REMOVED***
                'int_nn_int' => ['type' => 'int'***REMOVED***,
                'int_nn_checkbox' => ['type' => 'int'***REMOVED***,
                'id_int_nn_foreign_key' => ['type' => 'int', 'properties' => ['foreignKey'***REMOVED******REMOVED***
                'time_nn_time' => ['type' => 'time'***REMOVED***
                'text_nn_text' => ['type' => 'text'***REMOVED***,
                'text_nn_html' => ['type' => 'text'***REMOVED***
                'decimal_nn_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_nn_money_pt_br' => ['type' => 'decimal'***REMOVED***
                'datetime_nn_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_nn_datetime_pt_br' => ['type' => 'datetime'***REMOVED***
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
                'varchar_un_email' => ['type' => 'string'***REMOVED***
                'boolean_un_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_un_checkbox' => ['type' => 'boolean'***REMOVED***
                'int_un_int' => ['type' => 'int'***REMOVED***,
                'int_un_checkbox' => ['type' => 'int'***REMOVED***,
                'id_int_un_foreign_key' => ['type' => 'int', 'properties' => ['foreignKey'***REMOVED******REMOVED***
                'time_un_time' => ['type' => 'time'***REMOVED***
                'text_un_text' => ['type' => 'text'***REMOVED***,
                'text_un_html' => ['type' => 'text'***REMOVED***
                'decimal_un_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_un_money_pt_br' => ['type' => 'decimal'***REMOVED***
                'datetime_un_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_un_datetime_pt_br' => ['type' => 'datetime'***REMOVED***
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
                'varchar_un_nn_email' => ['type' => 'string'***REMOVED***
                'boolean_un_nn_int'  => ['type' => 'boolean'***REMOVED***,
                'boolean_un_nn_checkbox' => ['type' => 'boolean'***REMOVED***
                'int_un_nn_int' => ['type' => 'int'***REMOVED***,
                'int_un_nn_checkbox' => ['type' => 'int'***REMOVED***,
                'id_int_un_nn_foreign_key' => ['type' => 'int', 'properties' => ['foreignKey'***REMOVED******REMOVED***
                'time_un_nn_time' => ['type' => 'time'***REMOVED***
                'text_un_nn_text' => ['type' => 'text'***REMOVED***,
                'text_un_nn_html' => ['type' => 'text'***REMOVED***
                'decimal_un_nn_decimal' => ['type' => 'decimal'***REMOVED***,
                'decimal_un_nn_money_pt_br' => ['type' => 'decimal'***REMOVED***
                'datetime_un_nn_datetime' => ['type' => 'datetime'***REMOVED***,
                'datetime_un_nn_datetime_pt_br' => ['type' => 'datetime'***REMOVED***
                'date_un_nn_date' => ['type' => 'date'***REMOVED***,
                'date_un_nn_date_pt_br' => ['type' => 'date'***REMOVED***
            ***REMOVED***,
        ***REMOVED***
    ***REMOVED***;

    public function getColumnsNames()
    {
        return [
            'varchar_password_verify' => ['type' => 'string'***REMOVED***,
            'varchar_upload_image' => ['type' => 'string'***REMOVED***,
            'varchar_url' => ['type' => 'string'***REMOVED***,
            'varchar_varchar' => ['type' => 'string'***REMOVED***,
            'varchar_unique_id' => ['type' => 'string'***REMOVED***,
            'varchar_telephone' => ['type' => 'string'***REMOVED***,
            'varchar_email' => ['type' => 'string'***REMOVED***
            'boolean_int'  => ['type' => 'boolean'***REMOVED***,
            'boolean_checkbox' => ['type' => 'boolean'***REMOVED***
            'int_int' => ['type' => 'int'***REMOVED***,
            'int_checkbox' => ['type' => 'int'***REMOVED***,
            'id_int_foreign_key' => ['type' => 'int', 'properties' => ['foreignKey'***REMOVED******REMOVED***
            'time_time' => ['type' => 'time'***REMOVED***
            'text_text' => ['type' => 'text'***REMOVED***,
            'text_html' => ['type' => 'text'***REMOVED***
            'decimal_decimal' => ['type' => 'decimal'***REMOVED***,
            'decimal_money_pt_br' => ['type' => 'decimal'***REMOVED***
            'datetime_datetime' => ['type' => 'datetime'***REMOVED***,
            'datetime_datetime_pt_br' => ['type' => 'datetime'***REMOVED***
            'date_date' => ['type' => 'date'***REMOVED***,
            'date_date_pt_br' => ['type' => 'date'***REMOVED***
        ***REMOVED***;
    }

    /*
    public function createColumnTypeTable($suffix, $nullable, $unique)
    {
        $columnNames = $this->getColumnsNames();

        foreach ($columnNames as $type => $columns) {

            $options = [***REMOVED***;

            if ($type == 'int') {
                $type = 'integer';
            }

            $table = $this->table('columns_type_'.$type, ['id' => 'id_columns_type_'.$type***REMOVED***);

            $options['null'***REMOVED*** = $nullable;

            foreach ($columns as $columnData) {

                if ($type == 'decimal') {
                    $options['precision'***REMOVED*** = 10;
                    $options['scale'***REMOVED*** = 2;
                }

                if ($type == 'varchar') {
                    $options['limit'***REMOVED*** = ($columnData == 'varchar_varchar') ? 45 : 255;
                }

                $table->addColumn($columnData, $type, $options);
            }

            $table->create();
        }

    }

    public function createColumnTable($suffix, $nullable, $unique)
    {
        $columnNames = $this->getColumnsNames();

        foreach ($columnNames as $type => $columns) {

            foreach ($columns as $columnData) {

                $options = [***REMOVED***;

                if ($type == 'int') {
                    $type = 'integer';
                }

                if ($type == 'decimal') {
                    $options['precision'***REMOVED*** = 10;
                    $options['scale'***REMOVED*** = 2;
                }

                if ($type == 'varchar') {
                    $options['limit'***REMOVED*** = ($columnData == 'varchar_varchar') ? 45 : 255;
                }


                $table = $this->table('columns_'.$type.'_'.$columnData, ['id' => 'id_columns_'.$type.'_'.$columnData***REMOVED***);

                $table->addColumn($columnData, $type, $options);

                $table->create();

            }
        }

    }

    public function createAllColumnsDb($suffix, $nullable, $unique)
    {
        $columns = $this->getColumnsNames();

        $table = $this->table('all_columns_db'.$suffix, ['id' => 'id_all_columns_db'.$suffix***REMOVED***);

        foreach ($columns['string'***REMOVED*** as $columnName) {

            if ($columnName == 'varchar_varchar') {
                $limit = 45;
            } else {
                $limit = 255;
            }

            $table->addColumn($columnName.$suffix, 'string', ['null' => $nullable, 'limit' => $limit***REMOVED***);
        }

        foreach ($columns['date'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'date', ['null' => $nullable***REMOVED***);
        }

        foreach ($columns['datetime'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'datetime', ['null' => $nullable***REMOVED***);
        }

        foreach ($columns['time'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'time', ['null' => $nullable***REMOVED***);
        }

        foreach ($columns['decimal'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'decimal', ['null' => $nullable, 'precision' => 10, 'scale' => 2***REMOVED***);
        }

        foreach ($columns['int'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'integer', ['null' => $nullable***REMOVED***);
        }

        foreach ($columns['boolean'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'boolean', ['null' => $nullable***REMOVED***);
        }

        foreach ($columns['text'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'text', ['null' => $nullable***REMOVED***);
        }

        $table->addForeignKey('id_int_foreign_key'.$suffix, 'int_foreign_key', 'id_int_foreign_key', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        if ($unique) {

            $indexes = [***REMOVED***;

            foreach ($columns as $index => $columnsType) {

                if (!in_array($index, ['text', 'boolean'***REMOVED***)) {
                    foreach ($columnsType as $columnTyped) {
                        /* MARK AS IMPORTANT UNIQUE

                        if (!in_array($columnTyped, ['varchar_password_verify', 'int_checkbox', 'id_int_foreign_key', 'varchar_upload_image'***REMOVED***)) {
                            $table->addIndex($columnTyped.$suffix, ['unique' => true***REMOVED***);
                        }
                    }
                }
            }

        }
        $table->create();
    }
    */

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

         if ($unique) {
             $this->createUnique(&$table, $tableName, $columnName);
         }

         if (empty($properties)) {
             return;
         }

         foreach ($properties as $property) {

             switch ($property) {
                 case 'foreignKey':
                     $this->createForeignKey($table, $tableName, $columnName);
                     break;
             }
         }

         return true;

    }

    public function createTable($tableName, $options)
    {
        $table = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

        foreach ($options['columns'***REMOVED*** as $columnName => $column) {
            $nullable = (isset($column['nullable'***REMOVED***)) ? $column['nullable'***REMOVED*** : $options['nullable'***REMOVED***;
            $unique = (isset($column['unique'***REMOVED***)) ? $column['unique'***REMOVED*** : $options['unique'***REMOVED***;
            $properties = (isset($column['properties'***REMOVED***)) ? $column['properties'***REMOVED*** [***REMOVED***;
            $this->create($table, $tableName, $columnName, $column['type'***REMOVED***, $nullable, $unique);
        }

        $table->create();

        $this->createTableDependencies($tableName, $options['table'***REMOVED***);
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

        //foreach table call create table

        foreach (self::TABLES as $tableName => $options) {
            $this->createTable($tableName, $options);
        }
        /**
        $table = $this->table('int_dep_three', ['id' => 'id_int_dep_three'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();


        $tableForeign = $this->table('int_foreign_key', ['id' => 'id_int_foreign_key'***REMOVED***);
        $tableForeign->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $tableForeign->create();

        $this->createAllColumnsDb('', true, false);
        $this->createAllColumnsDb('_not_null', false, false);
        $this->createAllColumnsDb('_unique', true, true);
        $this->createAllColumnsDb('_unique_not_null', false, true);


        $this->createColumnTypeTable('', true, false);
        $this->createColumnTable('', true, false);

        //criar tabelas por tipo de coluna

        //criar tabelas por coluna em sí

        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_columns_db', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_columns_db', 'all_columns_db', 'id_all_columns_db', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        //$imageupload->addColumn('id_all_columns_db_not_null', 'integer', ['null' => true***REMOVED***);
        //$imageupload->addForeignKey('id_all_columns_db_not_null', 'all_columns_db_not_null', 'id_all_columns_db_not_null', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
       // $imageupload->addColumn('id_all_columns_db_mix', 'integer', ['null' => true***REMOVED***);
       // $imageupload->addForeignKey('id_all_columns_db_mix', 'all_columns_db_mix', 'id_all_columns_db_mix', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();


    }
}