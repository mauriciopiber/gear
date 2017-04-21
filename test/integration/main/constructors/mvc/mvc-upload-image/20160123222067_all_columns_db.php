
<?php

use Phinx\Migration\AbstractMigration;

class AllColumnsDb extends AbstractMigration
{

    public function getColumnsNames()
    {
        return [
            'string' => [
                'varchar_varchar',
            ***REMOVED***,
        ***REMOVED***;
    }

    /*
     * Cria tabelas com todas colunas possíveis.
     */
    public function createAllColumnsDb($suffix, $nullable, $unique)
    {
        $columns = $this->getColumnsNames();

        $table = $this->table('all_columns_db'.$suffix, ['id' => 'id_all_columns_db'.$suffix***REMOVED***);

        foreach ($columns['string'***REMOVED*** as $columnName) {

            if ($columnName == 'varchar_varchar') {
                $limit = 45;
            } else {
                $limit = 255;
            }

            $table->addColumn($columnName.$suffix, 'string', ['null' => $nullable, 'limit' => $limit***REMOVED***);
        }


        $table->create();

    }

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
        /**
        $table = $this->table('int_dep_three', ['id' => 'id_int_dep_three'***REMOVED***);
        $table->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $table->create();
        */

        //$tableForeign = $this->table('int_foreign_key', ['id' => 'id_int_foreign_key'***REMOVED***);
        //$tableForeign->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        //$tableForeign->create();

        $this->createAllColumnsDb('', true, false);
        //$this->createAllColumnsDb('_not_null', false, false);
        //$this->createAllColumnsDb('_unique', true, true);
        //$this->createAllColumnsDb('_unique_not_null', false, true);


        //$this->createColumnTypeTable('', true, false);
        //$this->createColumnTable('', true, false);

        //criar tabelas por tipo de coluna

        //criar tabelas por coluna em sí

        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_columns_db', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_columns_db', 'all_columns_db', 'id_all_columns_db', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        //$imageupload->addColumn('id_all_columns_db_not_null', 'integer', ['null' => true***REMOVED***);
        //$imageupload->addForeignKey('id_all_columns_db_not_null', 'all_columns_db_not_null', 'id_all_columns_db_not_null', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
       // $imageupload->addColumn('id_all_columns_db_mix', 'integer', ['null' => true***REMOVED***);
       // $imageupload->addForeignKey('id_all_columns_db_mix', 'all_columns_db_mix', 'id_all_columns_db_mix', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();


    }
}