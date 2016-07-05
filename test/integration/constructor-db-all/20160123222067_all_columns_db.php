
<?php

use Phinx\Migration\AbstractMigration;

class AllColumnsDb extends AbstractMigration
{
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
        $table = $this->table('int_dep_three', ['id' => 'id_int_dep_three'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();


        $table = $this->table('int_dep_four', ['id' => 'id_int_dep_four'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();

        $columns = [
            'all_columns',
            'email',
            'upload_image',
            'url',
            'telephone',
            'unique_id',
        ***REMOVED***;


        $table = $this->table('all_columns_db', ['id' => 'id_all_columns_db'***REMOVED***);

        foreach ($columns as $column) {
            $table->addColumn($column.'_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
            $table->addColumn($column.'_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        }


        /* TABLE 1 */

        $table->addColumn('date_enus', 'date', ['null' => true***REMOVED***);
        $table->addColumn('date_ptbr', 'date', ['null' => true***REMOVED***);
        $table->addColumn('datetime_enus', 'datetime', ['null' => true***REMOVED***);
        $table->addColumn('datetime_ptbr', 'datetime', ['null' => true***REMOVED***);
        $table->addColumn('time_enus', 'time', ['null' => true***REMOVED***);
        $table->addColumn('time_ptbr', 'time', ['null' => true***REMOVED***);
        $table->addColumn('text_enus', 'text', ['null' => true***REMOVED***);
        $table->addColumn('text_ptbr', 'text', ['null' => true***REMOVED***);
        $table->addColumn('decimal_enus', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('decimal_ptbr', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('int_enus', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('int_ptbr', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('checkbox', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('tinyint_enus', 'boolean', ['null' => true***REMOVED***);
        $table->addColumn('tinyint_ptbr', 'boolean', ['null' => true***REMOVED***);
        $table->addColumn('all_columns_upload_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $table->addColumn('all_columns_upload_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $table->addColumn('id_int_dep_three', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('id_int_dep_four', 'integer', ['null' => true***REMOVED***);
        $table->addForeignKey('id_int_dep_three', 'int_dep_three', 'id_int_dep_three', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->addForeignKey('id_int_dep_four', 'int_dep_four', 'id_int_dep_four', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));


        $table->create();


        $columns[***REMOVED*** = 'password_verify';

        $table = $this->table('all_columns_db_req', ['id' => 'id_all_columns_db_req'***REMOVED***);

        foreach ($columns as $column) {
            $table->addColumn($column.'_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
            $table->addColumn($column.'_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        }

        /* TABLE 2 */

        $table->addColumn('date_enus', 'date', ['null' => false***REMOVED***);
        $table->addColumn('date_ptbr', 'date', ['null' => false***REMOVED***);
        $table->addColumn('datetime_enus', 'datetime', ['null' => false***REMOVED***);
        $table->addColumn('datetime_ptbr', 'datetime', ['null' => false***REMOVED***);
        $table->addColumn('time_enus', 'time', ['null' => false***REMOVED***);
        $table->addColumn('time_ptbr', 'time', ['null' => false***REMOVED***);
        $table->addColumn('text_enus', 'text', ['null' => false***REMOVED***);
        $table->addColumn('text_ptbr', 'text', ['null' => false***REMOVED***);
        $table->addColumn('decimal_enus', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('decimal_ptbr', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('int_enus', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('int_ptbr', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('checkbox', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('tinyint_enus', 'boolean', ['null' => false***REMOVED***);
        $table->addColumn('tinyint_ptbr', 'boolean', ['null' => false***REMOVED***);
        $table->addColumn('all_columns_upload_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $table->addColumn('all_columns_upload_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $table->addColumn('id_int_dep_three', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('id_int_dep_four', 'integer', ['null' => false***REMOVED***);
        $table->addForeignKey('id_int_dep_three', 'int_dep_three', 'id_int_dep_three', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->addForeignKey('id_int_dep_four', 'int_dep_four', 'id_int_dep_four', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->create();




        $table = $this->table('all_columns_db_mix', ['id' => 'id_all_columns_db_mix'***REMOVED***);

        foreach ($columns as $column) {
            $table->addColumn($column.'_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
            $table->addColumn($column.'_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        }

        /* TABLE 3 */
        $table->addColumn('date_enus', 'date', ['null' => true***REMOVED***);
        $table->addColumn('date_ptbr', 'date', ['null' => true***REMOVED***);
        $table->addColumn('date_req_enus', 'date', ['null' => false***REMOVED***);
        $table->addColumn('date_req_ptbr', 'date', ['null' => false***REMOVED***);
        $table->addColumn('datetime_enus', 'datetime', ['null' => true***REMOVED***);
        $table->addColumn('datetime_ptbr', 'datetime', ['null' => true***REMOVED***);
        $table->addColumn('datetime_req_enus', 'datetime', ['null' => false***REMOVED***);
        $table->addColumn('datetime_req_ptbr', 'datetime', ['null' => false***REMOVED***);
        $table->addColumn('time_enus', 'time', ['null' => true***REMOVED***);
        $table->addColumn('time_ptbr', 'time', ['null' => true***REMOVED***);
        $table->addColumn('time_req_enus', 'time', ['null' => false***REMOVED***);
        $table->addColumn('time_req_ptbr', 'time', ['null' => false***REMOVED***);
        $table->addColumn('text_enus', 'text', ['null' => true***REMOVED***);
        $table->addColumn('text_ptbr', 'text', ['null' => true***REMOVED***);
        $table->addColumn('text_req_enus', 'text', ['null' => false***REMOVED***);
        $table->addColumn('text_req_ptbr', 'text', ['null' => false***REMOVED***);
        $table->addColumn('decimal_enus', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('decimal_ptbr', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('decimal_req_enus', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('decimal_req_ptbr', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $table->addColumn('int_enus', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('int_ptbr', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('checkbox', 'integer', ['null' => true***REMOVED***);
        $table->addColumn('int_req_enus', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('int_req_ptbr', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('checkbox_req', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('tinyint_enus', 'boolean', ['null' => true***REMOVED***);
        $table->addColumn('tinyint_ptbr', 'boolean', ['null' => true***REMOVED***);
        $table->addColumn('tinyint_req_enus', 'boolean', ['null' => false***REMOVED***);
        $table->addColumn('tinyint_req_ptbr', 'boolean', ['null' => false***REMOVED***);
        $table->addColumn('all_columns_upload_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        $table->addColumn('all_columns_upload_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        $table->addColumn('id_int_dep_three', 'integer', ['null' => false***REMOVED***);
        $table->addColumn('id_int_dep_four', 'integer', ['null' => true***REMOVED***);
        $table->addForeignKey('id_int_dep_three', 'int_dep_three', 'id_int_dep_three', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->addForeignKey('id_int_dep_four', 'int_dep_four', 'id_int_dep_four', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->create();

        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_columns_db', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_columns_db', 'all_columns_db', 'id_all_columns_db', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
       // $imageupload->addColumn('id_all_columns_db_req', 'integer', ['null' => true***REMOVED***);
       // $imageupload->addForeignKey('id_all_columns_db_req', 'all_columns_db_req', 'id_all_columns_db_req', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
       // $imageupload->addColumn('id_all_columns_db_mix', 'integer', ['null' => true***REMOVED***);
       // $imageupload->addForeignKey('id_all_columns_db_mix', 'all_columns_db_mix', 'id_all_columns_db_mix', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();


    }
}