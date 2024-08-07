<?php

use Phinx\Migration\AbstractMigration;

class MvcCompleteStrictUniqueNullableUploadImage extends AbstractMigration
{
    const TABLES = [
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
        ***REMOVED***,
        'mvc_cmp_str_uni_nul_upl' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'clm_txt_cmp_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htl_cmp_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dec_cmp_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dec_mny_cmp_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chb_cmp_str_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chb_cmp_str_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tim_cmp_str_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dat_cmp_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dat_pt_cmp_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pas_ver_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upl_img_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_id_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tel_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
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

    public function createColumn(&$table, $columnName, $type, $nullable, $unique)
    {
         $table->addColumn($columnName, $type, $this->getColumnConfig($type, $nullable));

        if ($unique && !in_array($type, ['text', 'boolean'***REMOVED***)) {
            $this->createUnique($table, $columnName);
        }

         return true;
    }

    public function createColumnForeignKey(&$table, $columnName)
    {
        $table->addForeignKey(
            $columnName,
            'column_int_foreign',
            'id_column_int_foreign',
            ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***
        );
    }

    public function createTable($tableName, $options)
    {
        $table = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

        foreach ($options['columns'***REMOVED*** as $columnName => $column) {
            $nullable = (isset($column['nullable'***REMOVED***)) ? $column['nullable'***REMOVED*** : $options['nullable'***REMOVED***;
            $unique = (isset($column['unique'***REMOVED***)) ? $column['unique'***REMOVED*** : $options['unique'***REMOVED***;
            //$properties = (isset($column['properties'***REMOVED***)) ? $column['properties'***REMOVED*** : [***REMOVED***;
            $this->createColumn($table, $columnName, $column['type'***REMOVED***, $nullable, $unique);

            if (isset($column['properties'***REMOVED***) && in_array('foreignKey', $column['properties'***REMOVED***)) {
                $this->createColumnForeignKey($table, $columnName);
            }
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
