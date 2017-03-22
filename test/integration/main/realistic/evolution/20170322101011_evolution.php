
<?php

use Phinx\Migration\AbstractMigration;

class Evolution extends AbstractMigration
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

        $tableForeign = $this->table('monthly', ['id' => 'id_monthly'***REMOVED***);
        $tableForeign->addColumn('name', 'string', ['null' => false***REMOVED***);
        $tableForeign->addColumn('month', 'string', ['null' => false***REMOVED***);
        $this->setUser($tableForeign);
        $tableForeign->create();
    }

    public function setUser(&$table)
    {
        $table->addColumn('created', 'datetime', array('null' => false))
        ->addColumn('created_by', 'integer', array('null' => false))
        ->addForeignKey('created_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))

        ->addColumn('updated', 'datetime', array('null' => true))
        ->addColumn('updated_by', 'integer', array('null' => true))
        ->addForeignKey('updated_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
    }
}