
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


        $table->create();

    }
}