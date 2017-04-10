
<?php

use Phinx\Migration\AbstractMigration;

class SrcDb extends AbstractMigration
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
        $table = $this->table('src_mvc_all', ['id' => 'id_src_mvc_all'***REMOVED***);
        $table->addColumn('src_name_all', 'string', ['limit' => 50***REMOVED***);
        $table->addColumn('mvc_name_all', 'string', ['limit' => 50***REMOVED***);
        $table->create();

        $table = $this->table('src_mvc_strict', ['id' => 'id_src_mvc_strict'***REMOVED***);
        $table->addColumn('src_name_strict', 'string', ['limit' => 50***REMOVED***);
        $table->addColumn('mvc_name_strict', 'string', ['limit' => 50***REMOVED***);
        $table->create();

        $table = $this->table('src_mvc_low_strict', ['id' => 'id_src_mvc_low_strict'***REMOVED***);
        $table->addColumn('src_name_low_strict', 'string', ['limit' => 50***REMOVED***);
        $table->addColumn('mvc_name_low_strict', 'string', ['limit' => 50***REMOVED***);
        $table->create();
    }
}