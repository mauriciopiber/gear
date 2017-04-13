
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
        $table = $this->table('src_mvc', ['id' => 'id_src_mvc'***REMOVED***);
        $table->addColumn('src_name', 'string', ['limit' => 50***REMOVED***);
        $table->addColumn('mvc_name', 'string', ['limit' => 50***REMOVED***);
        $table->create();
    }
}