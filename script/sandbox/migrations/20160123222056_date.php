<?php

use Phinx\Migration\AbstractMigration;

class Date extends AbstractMigration
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
        $dates = $this->table('all_dates', ['id' => 'id_all_dates'***REMOVED***);
        $dates->addColumn('date_enus', 'date', ['null' => false***REMOVED***);
        $dates->addColumn('date_ptbr', 'date', ['null' => false***REMOVED***);
        $dates->addColumn('datetime_enus', 'datetime', ['null' => false***REMOVED***);
        $dates->addColumn('datetime_ptbr', 'datetime', ['null' => false***REMOVED***);
        $dates->addColumn('time', 'time', ['null' => false***REMOVED***);
        $dates->addColumn('data_nome', 'text', ['null' => false***REMOVED***);
        $dates->create();
    }
}