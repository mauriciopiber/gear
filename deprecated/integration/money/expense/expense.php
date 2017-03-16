<?php

use Phinx\Migration\AbstractMigration;

class Expense extends AbstractMigration
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

        $expenseCycle = $this->table('expense_cycle', ['id' => 'id_expense_cycle'***REMOVED***);
        $expenseCycle->addColumn('name', 'string', ['null' => false***REMOVED***);
        $expenseCycle->create();

        $expenseRule = $this->table('expense_rule', ['id' => 'id_expense_rule'***REMOVED***);
        $expenseRule->addColumn('name', 'string', ['null' => false***REMOVED***);
        $expenseRule->create();

        $expense = $this->table('expense', ['id' => 'id_expense'***REMOVED***);
        $expense->addColumn('name', 'string', ['null' => false, 'limit' => 100***REMOVED***);
        $expense->addColumn('start_date', 'date', ['null' => false***REMOVED***);
        $expense->addColumn('end_date', 'date', ['null' => false***REMOVED***);
        $expense->addColumn('id_expense_cycle', 'integer', ['null' => false***REMOVED***);
        $expense->addForeignKey('id_expense_cycle', 'expense_cycle', 'id_expense_cycle', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $expense->addColumn('id_expense_rule', 'integer', ['null' => false***REMOVED***);
        $expense->addForeignKey('id_expense_rule', 'expense_rule', 'id_expense_rule', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $expense->addColumn('id_wallet', 'integer', ['null' => false***REMOVED***);
        $expense->addForeignKey('id_wallet', 'wallet', 'id_wallet', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $expense->create();



        /*
        $productTable = $this->table('product', ['id' => 'id_product'***REMOVED***);

        $productTable->addColumn('id_category', 'integer', ['null' => false***REMOVED***);
        $productTable->addColumn('price', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $productTable->addForeignKey('id_category', 'category', 'id_category', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $customerTable = $this->table('customer', ['id' => 'id_customer'***REMOVED***);
        $customerTable->addColumn('name', 'string', ['null' => false***REMOVED***);




        $orderTable = $this->table('customer_order', ['id' => 'id_customer_order'***REMOVED***);
        $orderTable->addColumn('id_product', 'integer', ['null' => false***REMOVED***);
        $orderTable->addColumn('id_customer', 'integer', ['null' => false***REMOVED***);

        $orderTable->addForeignKey('id_product', 'product', 'id_product', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $orderTable->addForeignKey('id_customer', 'customer', 'id_customer', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));


        $productTable->create();
        $customerTable->create();
        $orderTable->create();
        */
    }
}