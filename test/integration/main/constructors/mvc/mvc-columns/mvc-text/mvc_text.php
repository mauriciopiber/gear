<?php

use Phinx\Migration\AbstractMigration;

class MvcText extends AbstractMigration
{
    const TABLES = [
        'mvc_txt' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'clm_txt_txt' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_txt' => [
                    'type' => 'text'
                ***REMOVED***
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

    public function createColumn(&$table, $tableName, $columnName, $type, $nullable, $unique, $properties)
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
            $properties = (isset($column['properties'***REMOVED***)) ? $column['properties'***REMOVED*** : [***REMOVED***;
            $this->createColumn($table, $tableName, $columnName, $column['type'***REMOVED***, $nullable, $unique, $properties);
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
