<?php

use Phinx\Migration\AbstractMigration;

class Billing extends AbstractMigration
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

        $customer = $this->table('customer', ['id' => 'id_customer'***REMOVED***);
        $customer->addColumn('name', 'string', ['null' => false, 'limit' => 45***REMOVED***);
        $customer->addColumn('email', 'string', ['null' => false, 'limit' => 90***REMOVED***);
        $customer->create();

        $project = $this->table('project', ['id' => 'id_project'***REMOVED***);
        $project->addColumn('name', 'string', ['null' => false***REMOVED***);
        $project->addColumn('jira', 'string', ['null' => false***REMOVED***);
        $project->addColumn('total_billing', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $project->addColumn('total_time', 'integer', ['null' => false***REMOVED***);
        $project->addColumn('id_customer', 'integer', ['null' => false***REMOVED***);
        $project->addForeignKey('id_customer', 'customer', 'id_customer', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $project->create();

        $billing = $this->table('billing', ['id' => 'id_billing'***REMOVED***);
        $billing->addColumn('name', 'string', ['null' => false***REMOVED***);
        $billing->addColumn('overdue', 'date', ['null' => false***REMOVED***);
        $billing->addColumn('price', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $billing->addColumn('id_project', 'integer', ['null' => false***REMOVED***);
        $billing->addForeignKey('id_project', 'project', 'id_project', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $billing->create();

        $billingWallet = $this->table('billing_wallet', ['id' => 'id_billing_wallet'***REMOVED***);
        $billingWallet->addColumn('price', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2***REMOVED***);
        $billingWallet->addColumn('id_wallet', 'integer', ['null' => false***REMOVED***);
        $billingWallet->addForeignKey('id_wallet', 'wallet', 'id_wallet', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $billingWallet->addColumn('id_billing', 'integer', ['null' => false***REMOVED***);
        $billingWallet->addForeignKey('id_billing', 'billing', 'id_billing', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $billingWallet->create();

    }
}