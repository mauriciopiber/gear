
<?php

use Phinx\Migration\AbstractMigration;

class SimpleVarcharTable extends AbstractMigration
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
        $table = $this->table('simple_varchar_table', ['id' => 'id_simple_varchar_table'***REMOVED***);
        $table->addColumn('name', 'string', ['null' => true, 'limit' => 50***REMOVED***);
        $table->create();
    }
}