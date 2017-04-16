
<?php

use Phinx\Migration\AbstractMigration;

class UserTypeAll extends AbstractMigration
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
        $table = $this->table('user_type_all', ['id' => 'id_user_type_all'***REMOVED***);
        $table->addColumn('rules_all', 'string', ['null' => true, 'limit' => '50'***REMOVED***);
        $table->create();


        $table = $this->table('user_type_strict', ['id' => 'id_user_type_strict'***REMOVED***);
        $table->addColumn('rules_strict', 'string', ['null' => true, 'limit' => '50'***REMOVED***);
        $table->create();

        $table = $this->table('user_type_low_strict', ['id' => 'id_user_type_low_strict'***REMOVED***);
        $table->addColumn('rules_low_strict', 'string', ['null' => true, 'limit' => '50'***REMOVED***);
        $table->create();
    }
}