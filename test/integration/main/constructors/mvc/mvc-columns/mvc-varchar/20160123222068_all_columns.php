
<?php

use Phinx\Migration\AbstractMigration;

class AllColumns extends AbstractMigration
{

    public function getColumnsNames()
    {
        return [
            'string' => [
                'varchar_password_verify',
                'varchar_upload_image',
                'varchar_url',
                'varchar_varchar',
                'varchar_unique_id',
                'varchar_telephone',
                'varchar_email'
            ***REMOVED***,
        ***REMOVED***;
    }

    public function createAllColumnsDb()
    {
        $columns = $this->getColumnsNames();

        $table = $this->table('all_columns', ['id' => 'id_all_columns'***REMOVED***);

        foreach ($columns['string'***REMOVED*** as $columnName) {

            if ($columnName == 'varchar_varchar') {
                $limit = 45;
            } else {
                $limit = 255;
            }

            $table->addColumn($columnName, 'string', ['null' => true, 'limit' => $limit***REMOVED***);
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

        $tableForeign = $this->table('int_foreign_key', ['id' => 'id_int_foreign_key'***REMOVED***);
        $tableForeign->addColumn('dep_name', 'string', ['null' => false***REMOVED***);
        $tableForeign->create();

        $this->createAllColumnsDb();
        //$this->createAllColumnsDbNotNull();
        //$this->createAllColumnsDbUnique();
        //$this->createAllColumnsDbUniqueNotNull();

        //criar tabelas por tipo de coluna

        //criar tabelas por coluna em sí
/*
        $imageupload = $this->table('upload_image', ['id' => 'id_upload_image'***REMOVED***);
        $imageupload->addColumn('id_all_columns_db', 'integer', ['null' => true***REMOVED***);
        $imageupload->addForeignKey('id_all_columns_db', 'all_columns_db', 'id_all_columns_db', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        //$imageupload->addColumn('id_all_columns_db_not_null', 'integer', ['null' => true***REMOVED***);
        //$imageupload->addForeignKey('id_all_columns_db_not_null', 'all_columns_db_not_null', 'id_all_columns_db_not_null', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
       // $imageupload->addColumn('id_all_columns_db_mix', 'integer', ['null' => true***REMOVED***);
       // $imageupload->addForeignKey('id_all_columns_db_mix', 'all_columns_db_mix', 'id_all_columns_db_mix', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $imageupload->update();
*/

    }
}