
<?php

use Phinx\Migration\AbstractMigration;

class Book extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('book', ['id' => 'id_book'***REMOVED***);
        $table->addColumn('name', 'string', ['null' => true, 'limit' => 150***REMOVED***);

        $this->setUser($table);

        $table->create();
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