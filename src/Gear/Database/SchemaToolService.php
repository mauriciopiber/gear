<?php
namespace Gear\Database;

use Zend\Db\Metadata\Object\TableObject;
use Gear\Database\TableValidation;
use Gear\Database\AutoincrementServiceTrait;
use Gear\Database\TableServiceTrait;

class SchemaToolService extends DbAbstractService
{

    use AutoincrementServiceTrait;
    use TableServiceTrait;

    protected static $rowCount = 1;


    public function getTableDeep($tableObject)
    {
        return "".$this->stats[$tableObject***REMOVED***;
    }

    public function getTableOrder($mix)
    {
        return "".(10000-$mix);
    }

    public function getConstraintsByName($name)
    {
        if (!isset($this->stats[$name***REMOVED***)) {
            return;
        }

        $this->stats[$name***REMOVED*** = $this->stats[$name***REMOVED***+1;
        $constraints = $this->tables[$name***REMOVED***->getConstraints();

        $goingDeep = [***REMOVED***;

        if (count($constraints)>0) {
            foreach ($constraints as $constraint) {
                if ($constraint->getType() == 'FOREIGN KEY') {
                    $goingDeep[***REMOVED*** = $constraint;
                }
            }
        }


        if (count($goingDeep)>0) {
            foreach ($goingDeep as $constraint) {
                if ($constraint->getReferencedTableName() != $name) {
                    if (!in_array($constraint->getReferencedTableName(), $this->history)) {
                        $this->history[***REMOVED*** = $constraint->getReferencedTableName();
                        $this->getConstraintsByName($constraint->getReferencedTableName());
                    } else {
                        $this->stats[$name***REMOVED*** += 1;
                    }
                }
            }
        }
    }


    public function createBorder()
    {
        foreach (array_keys($this->tables) as $name) {

            $this->history = array();
            $this->getConstraintsByName($name);
        }
    }

    public function setUpStats()
    {
        $schema = $this->getSchema();

        $tables = $schema->getTables();

        $options = [***REMOVED***;
        $stats   = [***REMOVED***;

        foreach ($tables as $table) {
            $options[$table->getName()***REMOVED*** = $table;
            $stats[$table->getName()***REMOVED*** = 1;
        }

        $this->tables = $options;
        $this->stats  = $stats;

        $this->createBorder();
    }

    public function getOrderNumber($tableName)
    {
        $this->setUpStats();
        return $this->getTableOrder($this->getTableDeep($tableName));
    }

    public function getOrder()
    {

        $this->setUpStats();

        $tableScreen = $this->getOrderTable();

        foreach ($this->tables as $table) {
            $row = new \Zend\Text\Table\Row();
            $row->appendColumn(new \Zend\Text\Table\Column($this->str('label', $table->getName())));

            $deep = $this->getTableDeep($table->getName());
            $row->appendColumn(new \Zend\Text\Table\Column($deep));
            $row->appendColumn(new \Zend\Text\Table\Column($this->getTableOrder($deep)));
            $tableScreen->appendRow($row);
        }

        echo $tableScreen;
    }


    public function dropSystematicColumns(TableObject $table)
    {
        $table = $this->table($table->getName());

        if ($table->hasColumn('created')) {
            $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Dropping Column %s for %s', 'created', $table->getName()), 3);
            $this->dropCreated($table);
        } else {
            $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Column %s was dropped already from %s', 'created', $table->getName()), 2);
        }

        if ($table->hasColumn('updated')) {
             $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Dropping Column %s for %s', 'updated', $table->getName()), 3);
             $this->dropUpdated($table);
        } else {
            $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Column %s was dropped already from %s', 'updated', $table->getName()), 2);
        }

        if ($table->hasColumn('created_by')) {
             $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Dropping Column %s for %s', 'created_by', $table->getName()), 3);
             $this->dropCreatedBy($table);
        } else {
            $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Column %s was dropped already from %s', 'created_by', $table->getName()), 2);
        }

        if ($table->hasColumn('updated_by')) {
            $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Dropping Column %s for %s', 'updated_by', $table->getName()), 3);
            $this->dropUpdatedBy($table);
        } else {
            $this->getServiceLocator()
              ->get('console')
              ->writeLine(sprintf('Column %s was dropped already from %s', 'updated_by', $table->getName()), 2);
        }

        //var_dump($table);

        return true;
    }

    public function clearTable($tableName)
    {
        $table = $this->getSchema()->getTable($this->str('uline', $tableName));
        $tableScreen = $this->getTextTable();
        $tableScreen->appendRow($this->getTableObjectToRow($table));
        echo $tableScreen;
        //show table before execution.

        $this->dropSystematicColumns($table);

        $table = $this->getSchema()->getTable($this->str('uline', $tableName));
        $tableScreen = $this->getTextTable();
        $tableScreen->appendRow($this->getTableObjectToRow($table));
        echo $tableScreen;
        //show table after execution.
    }


    /**
     * Analisa uma tabela do banco de dados para encontrar irregularidades
     * e certificar que está criada corretamente no padrão gear.
     * @param string $tableName
     */
    public function doAnalyseTable($tableName)
    {
        $table = $this->getSchema()->getTable($this->str('uline', $tableName));

        static::$rowCount = 1;
        $tableScreen = $this->getTextTable();
        $tableScreen->appendRow($this->getTableObjectToRow($table));

        echo $tableScreen;
    }

    public function doAnalyseDatabase()
    {
        $schema = $this->getSchema();
        $tables = $schema->getTables();
        $tableScreen = $this->getTextTable();

        foreach ($tables as $table) {
            $tableScreen->appendRow($this->getTableObjectToRow($table));
            static::$rowCount += 1;
        }

        echo $tableScreen;
    }



    public function fixTable($tableName)
    {

        $schema = $this->getSchema();

        $table = $schema->getTable($this->str('uline', $tableName));

        $this->executeFix($table);


        $this->getTableService()->dropTable('phinxlog');

        return true;
    }

    public function except()
    {
        return ['migrations', 'phinxlog'***REMOVED***;
    }

    public function executeFix(TableObject $tableObject)
    {
        //if ($table)
        if (in_array($tableObject->getName(), $this->except())) {
            return;
        }

        $tableValidation = new TableValidation($tableObject);

        $noTruncate = $this->getRequest()->getParam('no-truncate', false);


        if ($noTruncate === false) {
            $this->getAutoincrementService()->truncate($tableObject);
        }

        if ($tableValidation->getCreated() != 'ok') {
            $this->createCreated($tableObject->getName());
        }
        if ($tableValidation->getUpdated() != 'ok') {
            $this->createUpdated($tableObject->getName());
        }
        if ($tableValidation->getCreatedBy() != 'ok') {
            $this->createCreatedBy($tableObject->getName());
        }
        if ($tableValidation->getUpdatedBy() != 'ok') {
            $this->createUpdatedBy($tableObject->getName());
        }

        $db = $this->injectDbWithTable($tableObject);

        if (!$this->validatePrimaryKey($db)) {
            $this->fixPrimaryKey($db);
        }

        return true;
    }

    public function fixDatabase()
    {
        $schema = $this->getSchema();

        $tables = $schema->getTables();

        foreach ($tables as $table) {
            $this->executeFix($table);
        }
    }

    /**
     *
     * @param GearJson\Db\Db $db
     * @return boolean
     */
    public function validatePrimaryKey($db)
    {
        $actualPrimaryKey = '';
        try {
            $actualPrimaryKey = $db->getPrimaryKeyColumnName();
        } catch (\Exception $e) {
            $actualPrimaryKey = false;
        }
        $namePrimaryToCompare = 'id_'.$this->str('uline', $db->getTable());

        if ($actualPrimaryKey == $namePrimaryToCompare) {
            $statusPrimary =  true;
        } else {
            $statusPrimary = false;
        }

        return $statusPrimary;
    }

    /**
     * @param GearJson\Db\Db $db
     */
    public function fixPrimaryKey($db)
    {
        $actualPrimaryKey = '';
        try {
            $actualPrimaryKey = $db->getPrimaryKeyColumnName();
        } catch (\Exception $e) {
            $actualPrimaryKey = false;
        }
        $namePrimaryToCompare = 'id_'.$this->str('uline', $db->getTable());

        $table = $this->table($db->getTable());


        if (false === $table->hasColumn($namePrimaryToCompare)) {
            $sql = sprintf(
                'ALTER TABLE %s ADD %s INT PRIMARY KEY AUTO_INCREMENT;',
                $db->getTable(),
                $namePrimaryToCompare
            );
            $this->getAdapter()->query($sql);
        }

        return;
    }

    /**
     * @param string $name Nome da Tabela
     */
    public function createCreated($name)
    {
        if ($name == 'user_role_linker') {
            return;
        }
        $table = $this->table($name);

        $table->hasColumn('created');

        if ($table->hasColumn('created')) {
            $table->removeColumn('created');
            $table->update();
        }

        $table->addColumn('created', 'datetime', array('null' => false));
        $table->update();
        $this->updateCreated($name);

        echo sprintf('Criado %s', 'created')."\n";
    }

    /**
     * @param string $name Nome da Tabela
     */
    public function createUpdated($name)
    {
        if ($name == 'user_role_linker') {
            return;
        }
        $table = $this->table($name);

        if ($table->hasColumn('updated')) {
            $table->removeColumn('updated');
            $table->update();
        }



        $table->addColumn('updated', 'datetime', array('null' => true));
        $table->update();
        echo sprintf('Criado %s', 'updated')."\n";
    }

    /**
     * @param string $name Nome da Tabela
     */
    public function createUpdatedBy($name)
    {
        if ($name == 'user_role_linker') {
            return;
        }

        $table = $this->table($name);
        if ($table->hasColumn('updated_by')) {
            $this->dropUpdatedBy($table);
        }

        $table->addColumn('updated_by', 'integer', array('limit' => 1, 'null' => true))
        ->addForeignKey('updated_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->update();
        echo sprintf('Criado %s', 'updated_by')."\n";
    }

    /**
     * @param string $name Nome da Tabela
     */
    public function createCreatedBy($name)
    {
        if ($name == 'user_role_linker') {
            return;
        }
        $table = $this->table($name);


        if ($table->hasColumn('created_by')) {
            $table->dropForeignKey('created_by');
            $table->removeColumn('created_by');
            $table->update();
        }

        if ($name == 'user') {
            $options = array('null' => true);
        } else {
            $options = array('null' => false);
        }

        $table->addColumn('created_by', 'integer', array_merge(array('limit' => 1), $options));

        $tableHasData = $this->tableHasData($name);

        if ($tableHasData) {
            $table->update();
            $this->updateCreatedBy($name);
        }

        $table->addForeignKey('created_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));

        $table->update();
        echo sprintf('Criado %s', 'created_by')."\n";
    }

    public function tableHasData($tableName)
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $select = new \Zend\Db\Sql\Select();
        $select->from($tableName);


        $sql = $select->getSqlString($dbAdapter->getPlatform());

        $data = $dbAdapter->query($sql)->execute();

        if ($data->count() >= 1) {
            return true;
        }

        return false;
    }

    public function updateCreatedBy($tableName)
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');


        $update = new \Zend\Db\Sql\Update($tableName);
        $update->set(
            [
                'created_by' => 1
            ***REMOVED***
        );

        $primaryKey = 'id_'.$this->str('uline', $tableName);


        $update->where(function ($where) use ($primaryKey) {
            $where->isNotNull($primaryKey);
        });

        $sql = $update->getSqlString($dbAdapter->getPlatform());

        return $dbAdapter->query($sql)->execute();
    }

    public function updateCreated($tableName)
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');


        $update = new \Zend\Db\Sql\Update($tableName);
        $update->set(
            [
                'created' => (new \DateTime('now'))->format('Y-m-d H:i:s')
            ***REMOVED***
        );

        $primaryKey = 'id_'.$this->str('uline', $tableName);


        $update->where(function ($where) use ($primaryKey) {
            $where->isNotNull($primaryKey);
        });

        $sql = $update->getSqlString($dbAdapter->getPlatform());

        return $dbAdapter->query($sql)->execute();
    }

    /**
     *
     * @param Zend\Db\Metadata\TableObject $table
     * @return \GearJson\Db\Db
     */
    public function injectDbWithTable($table)
    {
        $data = array(
            'table' => $this->str('uline', $table->getName()),
            'tableObject' => $table,
            'columns' => array()
        );

        $db = new \GearJson\Db\Db($data);
        return $db;
    }

    public function getTextTable()
    {
        $tableScreen = new \Zend\Text\Table\Table(array('columnWidths' => array(10, 20, 30, 15, 20, 20, 20, 20)));
        // Either simple
        $tableScreen->appendRow(
            array(
                'Id',
                'Name',
                'PrimaryKeyName',
                'PrimaryStatus',
                'Created Time',
                'Created By',
                'Updated Time',
                'Updated By'
            )
        );
        return $tableScreen;

    }

    public function getOrderTable()
    {
        $tableScreen = new \Zend\Text\Table\Table(array('columnWidths' => array(30, 10, 10)));
        // Either simple
        $tableScreen->appendRow(array('Name', 'Deep', 'Order'));

        return $tableScreen;

    }

    /**
     * @param GearJson\Db\Db $db
     * @return string
     */
    public function getPrimaryKeyName($db)
    {
        try {
            $primaryKeyName = $db->getPrimaryKeyColumnName();
        } catch (\Exception $e) {
            $primaryKeyName = '';
        }

        return $primaryKeyName;
    }



    public function getTableObjectToRow(TableObject $tableObject)
    {
        $db = $this->injectDbWithTable($tableObject);

        $tableValidation = new TableValidation($tableObject);

        if ($this->validatePrimaryKey($db)) {
            $statusPrimary = 'ok';
        } else {
            $statusPrimary = 'fix';
        }

        // Or verbose
        $row = new \Zend\Text\Table\Row();
        $row->appendColumn(new \Zend\Text\Table\Column("".static::$rowCount));
        $row->appendColumn(new \Zend\Text\Table\Column($this->str('label', $tableObject->getName())));
        $row->appendColumn(new \Zend\Text\Table\Column($this->getPrimaryKeyName($db)));
        $row->appendColumn(new \Zend\Text\Table\Column($statusPrimary));
        $row->appendColumn(new \Zend\Text\Table\Column($tableValidation->getCreated()));
        $row->appendColumn(new \Zend\Text\Table\Column($tableValidation->getCreatedBy()));
        $row->appendColumn(new \Zend\Text\Table\Column($tableValidation->getUpdated()));
        $row->appendColumn(new \Zend\Text\Table\Column($tableValidation->getUpdatedBy()));

        return $row;
    }

    public function dropCreatedBy($table)
    {
        $table->dropForeignKey('created_by');
        $table->removeColumn('created_by');
        $table->update();
    }

    public function dropUpdatedBy($table)
    {
        $table->dropForeignKey('updated_by');
        $table->removeColumn('updated_by');
        $table->update();
    }

    public function dropCreated($table)
    {
        $table->removeColumn('created');
        $table->update();
    }

    public function dropUpdated($table)
    {
        $table->removeColumn('updated');
        $table->update();
    }
}
