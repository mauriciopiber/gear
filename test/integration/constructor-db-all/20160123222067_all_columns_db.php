
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

        $table = $this->table('all_columns_db', ['id' => 'id_all_columns_db'***REMOVED***);

        $columns = $this->getColumnsNames();

        foreach ($columns['string'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        }

        foreach ($columns['date'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'date', ['null' => true***REMOVED***);
        }

        foreach ($columns['datetime'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'datetime', ['null' => true***REMOVED***);
        }

        foreach ($columns['time'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'time', ['null' => true***REMOVED***);
        }

        foreach ($columns['decimal'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        }

        foreach ($columns['int'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'integer', ['null' => true***REMOVED***);
        }

        foreach ($columns['tinyint'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'boolean', ['null' => true***REMOVED***);
        }

        foreach ($columns['text'***REMOVED*** as $columnName) {
            $table->addColumn($columnName, 'text', ['null' => true***REMOVED***);
        }

        $table->addForeignKey('id_int_foreign_key', 'int_foreign_key', 'id_int_foreign_key', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        //$table->addForeignKey('id_int_dep_four', 'int_dep_four', 'id_int_dep_four', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));



        $table->create();

        $table2 = $this->table('all_columns_db_not_null', ['id' => 'id_all_columns_db_not_null'***REMOVED***);

        foreach ($columns['string'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        }

        foreach ($columns['date'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'date', ['null' => false***REMOVED***);
        }

        foreach ($columns['datetime'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'datetime', ['null' => false***REMOVED***);
        }

        foreach ($columns['time'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'time', ['null' => false***REMOVED***);
        }

        foreach ($columns['decimal'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        }

        foreach ($columns['int'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'integer', ['null' => false***REMOVED***);
        }

        foreach ($columns['tinyint'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'boolean', ['null' => false***REMOVED***);
        }

        foreach ($columns['text'***REMOVED*** as $columnName) {
            $table2->addColumn($columnName.'_not_null', 'text', ['null' => false***REMOVED***);
        }

        $table2->addForeignKey('id_int_foreign_key_not_null', 'int_foreign_key', 'id_int_foreign_key', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        //$table->addForeignKey('id_int_dep_four', 'int_dep_four', 'id_int_dep_four', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $table2->create();



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