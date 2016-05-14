<?php

use Phinx\Migration\AbstractMigration;

class StartEvolution extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $year =  $this->table('year_sprint', ['id' => 'id_year_sprint'***REMOVED***);
        $year->addColumn('start_date', 'datetime', ['null' => false***REMOVED***);
        $year->addColumn('end_date', 'datetime', ['null' => false***REMOVED***);
        $year->create();

        $month =  $this->table('month_sprint', ['id' => 'id_month_sprint'***REMOVED***);
        $month->addColumn('start_date', 'datetime', ['null' => false***REMOVED***);
        $month->addColumn('end_date', 'datetime', ['null' => false***REMOVED***);
        $month->addColumn('id_year_sprint', 'integer', ['null' => false***REMOVED***);
        $month->addForeignKey('id_year_sprint', 'year_sprint', 'id_year_sprint', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);
        $month->create();


        $week = $this->table('week_sprint', ['id' => 'id_week_sprint'***REMOVED***);
        $week->addColumn('start_date', 'datetime', ['null' => false***REMOVED***);
        $week->addColumn('end_date', 'datetime', ['null' => false***REMOVED***);
        $week->addColumn('id_month_sprint', 'integer', ['null' => false***REMOVED***);
        $week->addForeignKey('id_month_sprint', 'month_sprint', 'id_month_sprint', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);
        $week->create();

        $day = $this->table('day_sprint', ['id' => 'id_day_sprint'***REMOVED***);
        $day->addColumn('start_date', 'datetime', ['null' => false***REMOVED***);
        $day->addColumn('end_date', 'datetime', ['null' => false***REMOVED***);
        $day->addColumn('id_week_sprint', 'integer', ['null' => false***REMOVED***);
        $day->addForeignKey('id_week_sprint', 'week_sprint', 'id_week_sprint', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);
        $day->create();




        //criar tabela sprint_anual
        //criar tabela sprint_mensal
        //criar tabela sprint_semanal
        //criar tabela sprint_diario


    }
}
