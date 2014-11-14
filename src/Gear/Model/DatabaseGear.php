<?php
namespace Gear\Model;
/**
 * @author piber
*/
class DatabaseGear extends MakeGear implements  \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    public $em;
    public $adapter;
    private $project;
    private $moduleType;
    private $roles;

    public function __construct()
    {

    }
    /**
     * Refactoring
     */

    public function clearRules()
    {
        $connection = $this->getEntityManager()->getConnection();

        $sql = 'DELETE FROM rule WHERE 1=1;';
        $connection->exec($sql);

        $sql = 'DELETE FROM action WHERE 1=1;';
        $connection->exec($sql);

        $sql = 'DELETE FROM controller WHERE 1=1;';
        $connection->exec($sql);

        $sql = 'DELETE FROM man_module WHERE 1=1;';
        $connection->exec($sql);
    }

    /**
     * End Refactoring
     */

    public function dropi18n($i18nPrefix)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $connection = $this->getEntityManager()->getConnection();
        //$schema->getColum
        foreach ($schema->getTables() as $i => $v) {

            if ($v->getName()==$i18nPrefix) {
                continue;
            }
            if (strpos($v->getName(),$i18nPrefix) !== false) {
                $sqlSelect    = $this->getSQLSelectI18nData($v,$i18nPrefix);

                $dataToBackup = $this->getBackupData($sqlSelect);

                $sqlAlterTable = $this->getSQLAlterTable($v,$sqlSelect['data'***REMOVED***,$i18nPrefix);

                $connection->query($sqlAlterTable);

                $sqlUpdadeBackup = $this->getSQLUpdate($v,$dataToBackup,$i18nPrefix);

                $connection->query($sqlUpdadeBackup);

                $sqlDropI18n = $this->getSQLDrop($v);

                $connection->query($sqlDropI18n);
            }

            foreach ($schema->getColumns($v->getName()) as $a => $b) {

                if (strpos($b->getName(),$i18nPrefix)) {
                    $this->dropTableColumn($v->getName(),$b->getName());
                }
                //
            }
        }
    }

    public function executeSql($sql)
    {
        $connection = $this->getEntityManager()->getConnection();

        return $connection->query($sql);
    }

    public function dropTableFK($table,$column)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $fk = $schema->getConstraints($table);

        foreach ($fk as $i => $b) {

            if ($b->getType()=='FOREIGN KEY') {
                $columns = $b->getColumns();
                $target = array_pop($columns);
                if ($target==$column) {

                    $sql = 'ALTER TABLE '.$table.' DROP FOREIGN KEY '.$b->getName();
                    $this->executeSql($sql);
                    //var_dump($b);
                }
            }
        }
    }

    public function dropTableColumn($table,$column)
    {
        $this->dropTableFK($table,$column);
        $sql = 'ALTER TABLE '.$table.' DROP COLUMN '.$column;

        return $this->executeSql($sql);

    }

    public function getSQLUpdate($table,$data,$i18nPrefix)
    {
        $primaryKey  = $this->getTargetPrimaryKey($table->getName(), $i18nPrefix);
        $sqlUpdate = '';
        foreach ($data as $c => $x) {

            $sqlUpdate .= 'UPDATE '.str_replace('_'.$i18nPrefix, '', $table->getName()).' SET ';

            $iterator = 0;

            foreach ($x as $l => $s) {
                $iterator += 1;
                if ($l == $primaryKey) {
                    continue;
                } else {
                    $sqlUpdate .= ''.$l.' = "'.htmlspecialchars($s).'"';

                    if ($iterator < (count($x))) {
                        $sqlUpdate .= ',';
                    }
                }
            }
            $sqlUpdate .= ' WHERE '.$primaryKey.' = '.$x[$primaryKey***REMOVED***.';';

        }
        //var_dump($sqlUpdate);
        return $sqlUpdate;

    }

    public function getTargetTable($table_i18n,$prefix)
    {
        return str_replace('_'.$prefix, '', $table_i18n);
    }

    public function getTargetPrimaryKey($table_i18n,$prefix)
    {
        return 'id_'.str_replace('_'.$prefix, '', $table_i18n);
    }

    public function getTableAlias($table)
    {
        return strtoupper(substr($table, 0,1));
    }

    /**
     *
     * @param  unknown $tableObject
     * @param  unknown $i18nPrefix
     * @return array   [SQL,DataConvertida***REMOVED***
     */
    public function getSQLSelectI18nData($tableObject,$i18nPrefix)
    {
        $primaryKey  = $this->getTargetPrimaryKey($tableObject->getName(), $i18nPrefix);

        $tpx         = $this->getTableAlias($tableObject->getName());

        $sql = 'SELECT '.$tpx.'.'.$primaryKey.',';

        $convert = array($primaryKey);
        $columns = $tableObject->getColumns();

        $cc = count($columns);
        foreach ($columns as $a => $b) {

            if (in_array($b->getDataType(),array('text','varchar'))) {
                $convert[***REMOVED*** = $b->getName();
            }
            $sql .= $tpx.'.'.$b->getName();

            if ($a < ($cc-1)) {
                $sql .= ', ';
            }
        }
        //var_dump($convert);
        $sql .= ' FROM '.$tableObject->getName().' '.$tpx.' WHERE '.$tpx.'.id_idioma = 1;';
//echo $sql."\n";
        return array('sql' => $sql,'data' => $convert);
    }

    public function getBackupData($sqlSelect)
    {
        $connection = $this->getEntityManager()->getConnection();

        $dataset = $connection->query($sqlSelect['sql'***REMOVED***);

        $dataToInsert = [***REMOVED***;

        while ($row = $dataset->fetch()) {
            $entity = array();
            foreach ($sqlSelect['data'***REMOVED*** as $m => $n) {
                $entity[$n***REMOVED*** = $row[$n***REMOVED***;
            }
            $dataToInsert[***REMOVED*** = $entity;
        }

        return $dataToInsert;

    }

    public function getSQLAlterTable($table,$columns,$i18nPrefix)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $targetTable = $this->getTargetTable($table->getName(), $i18nPrefix);

        $sqlChangeTable = 'ALTER TABLE '.$targetTable.' ';

        unset($columns[0***REMOVED***);

        foreach ($columns as $a => $b) {

            $column = $schema->getColumn($b, $table->getName());

            $sqlChangeTable .= 'ADD COLUMN '.$column->getName().' ';

            $sqlChangeTable .= ($column->getDataType()=='varchar') ? $column->getDataType().'('.$column->getCharacterMaximumLength().')' : $column->getDataType();

            $sqlChangeTable .= ($column->isNullable()) ? ' NULL' : ' NOT NULL';

            if ($a < (count($columns))) {
                $sqlChangeTable .= ', ';
            } else {
                $sqlChangeTable .= ';';
            }

        }

        return $sqlChangeTable;

    }

    public function getSQLDrop($table)
    {
        return 'DROP TABLE '.$table->getName().';';
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $service = $this->getServiceLocator();
            $em = $service->get('doctrine.entitymanager.orm_default');
            $this->em = $em;
        }

        return $this->em;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->sm;
    }


    public function setCreated($column)
    {
        //var_dump($column);die();
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'ALTER TABLE '.$column->getName().' ADD COLUMN created datetime not null';
        $connection->query($sql);
        //echo $sql;
        //$connection->query();
    }

    public function setUpdated($column)
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'ALTER TABLE '.$column->getName().' ADD COLUMN updated datetime null';
        $connection->query($sql);
    }

    public function checkTableCreatedUpdated($tables)
    {
        foreach ($tables as $a => $b) {

            $created = null;
            $updated = null;

            foreach ($b->getColumns() as $i => $v) {

                if ($v->getName()=='created') {
                    $created = true;
                    continue;
                } elseif ($v->getName()=='updated') {
                    $updated = true;
                    continue;
                }
                //echo $v->getName()."\n";
                //
            }

            if ($created==null) {
                echo 'Necessário criar campo created na tabela '.$b->getName()."\n";
                $this->setCreated($b);
            }
            if ($updated==null) {
                echo 'Necessário criar campo updated na tabela '.$b->getName()."\n";
                $this->setUpdated($b);
            }
        }
    }

    public function checkPrimaryKey($fixFirstId,$prefix)
    {
        foreach ($fixFirstId as $i => $v) {

            if ($prefix) {
                $table_name = str_replace($prefix.'_','',$v->getName());
            } else {
                $table_name = $v->getName();
            }
            $fk = $this->getFKAllTables($v);
            foreach ($fk as $a => $b) {
                $this->dropFK($b);
            }

            $this->alterPrimaryKey($v,$table_name);

            foreach ($fk as $a => $b) {
                $this->createFK($b,$table_name);
            }
        }

        return true;
    }

    public function checkNormalization($prefix,$exclude = false)
    {

        $sql = $this->getServiceLocator()->get('sql_gear');

        $connection = $this->getEntityManager()->getConnection();
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $tables = $this->getTablesFromPrefix($prefix);

        $fixFirstId = [***REMOVED***;

        foreach ($tables as $i => $v) {

            if ($prefix) {
                $table_name = str_replace($prefix.'_','',$v->getName());
            } else {
                $table_name = $v->getName();
            }

            $primary_key = $this->getPrimaryKey($v);
            $columns = $primary_key->getColumns();

            if ('id_'.$table_name != array_pop($columns)) {
                $fixFirstId[***REMOVED*** = $v;
            }
        }

        $this->checkPrimaryKey($fixFirstId,$prefix);

        $this->checkTableCreatedUpdated($tables);

              /**
         *    /**
         * Função de normalização de Primary Key.
         *
         * verificar se tem Foreign Key.
         * Se tiver foreign key em outra tabela. Salvar foreign_key
         * deletar foreign key
         * criar campo pk_temp na tabela
         * definir primary key como pk_temp
         * renomear campo Primary Key para nome normalizado.
         * definir Primary Key na ID novamente.
         * deletar pk_temp
         * definir foreign key salvo novamente.
         */
    }

    public function alterPrimaryKey($primary_key,$id_table_name)
    {
        $columns = $this->getPrimaryKey($primary_key);
        $pk = $columns->getColumns();
        //var_dump($columns);die();
        echo 'ALTER TABLE '.$primary_key->getName().' CHANGE '.array_pop($pk).' id_'.$id_table_name.' INT NOT NULL AUTO_INCREMENT;'
        ."\n";

    }

    public function dropFK($foreign_key)
    {
        echo 'ALTER TABLE '.$foreign_key->getTableName().' DROP FOREIGN KEY '.$foreign_key->getName().';'."\n";
    }

    public function createFK($foreign_key,$reference)
    {

        $fk = $foreign_key->getColumns();
        $getIdForeign = array_pop($fk);

        echo  'ALTER TABLE '.$foreign_key->getTableName().' '
             .'ADD CONSTRAINT '.$foreign_key->getName().' FOREIGN KEY ('.$getIdForeign.') '
             .'REFERENCES '.$foreign_key->getReferencedTableName().'(id_'.$reference.') '
             .'ON UPDATE '.$foreign_key->getUpdateRule().' '
             .'ON DELETE '.$foreign_key->getDeleteRule().';'
             ."\n";
    }

    public function getFKAllTables($table)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $pk = $this->getPrimaryKey($table);

        $allFK = [***REMOVED***;

        //var_dump($pk);
        foreach ($schema->getTables() as $i => $v) {
            $foreign = $this->getForeignKey($v);
            foreach ($foreign as $a => $b) {
                if ($b->getReferencedTableName() == $table->getName()) {
                    $allFK[***REMOVED*** = $b;
                }
            }
        }

        return $allFK;
    }



}
