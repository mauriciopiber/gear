<?php

use Phinx\Migration\AbstractMigration;

class Each extends AbstractMigration
{
    const TABLES = [
        'src_mvc_cmp_lws_uni_nul' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'clm_txt_cmp_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htl_cmp_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dec_cmp_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dec_mny_cmp_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chb_cmp_lws_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chb_cmp_lws_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tim_cmp_lws_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dat_cmp_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dat_pt_cmp_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pas_ver_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upl_img_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_id_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tel_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
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
