
<?php

use Phinx\Migration\AbstractMigration;

class VarcharDb extends AbstractMigration
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
            'varchar',
            'email',
            'upload_image',
            'url',
            'telephone',
            'unique_id',
            'password_verify'
        ***REMOVED***;


        $table = $this->table('varchar_db', ['id' => 'id_varchar_db'***REMOVED***);

        foreach ($columns as $column) {
            $table->addColumn($column.'_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
            $table->addColumn($column.'_two', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
        }

        $table->create();


        $table = $this->table('varchar_db_req', ['id' => 'id_varchar_db_req'***REMOVED***);

        foreach ($columns as $column) {
            $table->addColumn($column.'_one', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
            $table->addColumn($column.'_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        }


        $table->create();

        $table = $this->table('varchar_db_mix', ['id' => 'id_varchar_db_mix'***REMOVED***);

        foreach ($columns as $column) {
            $table->addColumn($column.'_one', 'string', ['null' => true, 'limit' => '255'***REMOVED***);
            $table->addColumn($column.'_two', 'string', ['null' => false, 'limit' => '255'***REMOVED***);
        }

        $table->create();

    }
}