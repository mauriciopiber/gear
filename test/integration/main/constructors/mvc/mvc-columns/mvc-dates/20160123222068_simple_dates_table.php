
<?php

use Phinx\Migration\AbstractMigration;

class SimpleDatesTable extends AbstractMigration
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
        $table = $this->table('simple_dates_table', ['id' => 'id_simple_dates_table'***REMOVED***);
        $table->addColumn('simple_date', 'date');
        $table->addColumn('simple_datetime', 'datetime');
        $table->addColumn('simple_time', 'time');
        $table->create();
    }
}