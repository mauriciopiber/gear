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


        $productTable = $this->table('product', ['id' => 'id_product'***REMOVED***);
        $productTable->addColumn('name', 'string', ['null' => false***REMOVED***);
        $productTable->addColumn('id_category', 'integer', ['null' => false***REMOVED***);
        $productTable->addColumn('price', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $productTable->addForeignKey('id_category', 'category', 'id_category', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $customerTable = $this->table('customer', ['id' => 'id_customer'***REMOVED***);
        $customerTable->addColumn('name', 'string', ['null' => false***REMOVED***);


        $categoryTable = $this->table('category', ['id' => 'id_category'***REMOVED***);
        $categoryTable->addColumn('name', 'string', ['null' => false***REMOVED***);



        $orderTable = $this->table('customer_order', ['id' => 'id_customer_order'***REMOVED***);
        $orderTable->addColumn('id_product', 'integer', ['null' => false***REMOVED***);
        $orderTable->addColumn('id_customer', 'integer', ['null' => false***REMOVED***);

        $orderTable->addForeignKey('id_product', 'product', 'id_product', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $orderTable->addForeignKey('id_customer', 'customer', 'id_customer', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $categoryTable->create();
        $productTable->create();
        $customerTable->create();
        $orderTable->create();



    }
}