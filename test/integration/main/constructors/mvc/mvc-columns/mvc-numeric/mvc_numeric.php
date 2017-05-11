<?php

use Phinx\Migration\AbstractMigration;

class MvcNumeric extends AbstractMigration
{
    const TABLES = [
        'mvc_nmr' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'clm_dcm_nmr' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_nmr' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_nmr' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_nmr' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_nmr' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_nmr' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_nmr' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'clm_int_frk' => [
            'nullable' => true,
            'unique' => false,
            'columns' => [
                'clm_int_frk_name' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***,
            'table' => [

            ***REMOVED***
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
