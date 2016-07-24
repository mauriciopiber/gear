
<?php

use Phinx\Migration\AbstractMigration;

class AllColumnsDb extends AbstractMigration
{

    public function getColumnsNames()
    {
        return [
            'string' => [
                'varchar_password_verify',
                'varchar_upload_image',
                'varchar_url',
                'varchar_varchar',
                'varchar_unique_id',
                'varchar_telephone',
                'varchar_email'
            ***REMOVED***,
            'tinyint' => [
                'tinyint_tinyint',
                'tinyint_checkbox'
            ***REMOVED***,
            'int' => [
                'int_int',
                'int_checkbox',
                'id_int_foreign_key'
            ***REMOVED***,
            'time' => [
                'time_time'
            ***REMOVED***,
            'text' => [
                'text_text',
                'text_html'
            ***REMOVED***,
            'decimal' => [
                'decimal_decimal',
                'decimal_money_pt_br'
            ***REMOVED***,
            'datetime' => [
                'datetime_datetime',
                'datetime_datetime_pt_br'
            ***REMOVED***,
            'date' => [
                'date_date',
                'date_date_pt_br'
            ***REMOVED***
        ***REMOVED***;
    }

    public function createColumnTypeTable($suffix, $nullable, $unique)
    {
        $columns = $this->getColumnsNames();
    }

    public function createColumnTable($suffix, $nullable, $unique)
    {
        $columns = $this->getColumnsNames();
    }

    /*
     * Cria tabelas com todas colunas possíveis.
     */
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

        foreach ($columns['tinyint'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'boolean', ['null' => $nullable***REMOVED***);
        }

        foreach ($columns['text'***REMOVED*** as $columnName) {
            $table->addColumn($columnName.$suffix, 'text', ['null' => $nullable***REMOVED***);
        }

        $table->addForeignKey('id_int_foreign_key'.$suffix, 'int_foreign_key', 'id_int_foreign_key', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        if ($unique) {

            $indexes = [***REMOVED***;

            foreach ($columns as $index => $columnsType) {

                if (!in_array($index, ['text', 'tinyint'***REMOVED***)) {
                    foreach ($columnsType as $columnTyped) {

                        if (!in_array($columnTyped, ['varchar_password_verify', 'int_checkbox', 'id_int_foreign_key', 'varchar_upload_image'***REMOVED***)) {
                            $table->addIndex($columnTyped.'_unique_not_null', ['unique' => true***REMOVED***);
                        }
                    }
                }
            }

        }

        $table->create();
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
        /**
        $table = $this->table('int_dep_three', ['id' => 'id_int_dep_three'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();
        */

        $tableForeign = $this->table('int_foreign_key', ['id' => 'id_int_foreign_key'***REMOVED***);
        $tableForeign->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $tableForeign->create();

        $this->createAllColumnsDb('', true, false);
        $this->createAllColumnsDb('_not_null', true, false);
        $this->createAllColumnsDb('_unique', true, false);
        $this->createAllColumnsDb('_unique_not_null', true, false);


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