<?php
namespace Gear\Service\Db;

use Gear\Service\AbstractJsonService;
use Zend\Console\ColorInterface;
use Zend\Db\Metadata\Object\TableObject;

class SchemaToolService extends DbAbstractService
{

    protected $schema;

    protected static $rowCount = 1;

    public function getSchema()
    {
        if (!isset($this->schema)) {
            $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
            $this->schema = $schema;
        }

        return $this->schema;
    }

    /**
     * Executa Truncate na tabela $tableName
     * @param string $tableName
     */
    public function autoincrementTable($tableName)
    {
        $schema = $this->getSchema();
        $table = $schema->getTable($this->str('uline', $tableName));

        return $this->truncate($table);

    }

    public function truncate(TableObject $table)
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $this->outputConsole(sprintf('Truncate Table %s', $table->getName()), 3);
        $connection = $em->getConnection();
        $connection->beginTransaction();
        try {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->query(sprintf('TRUNCATE %s;', $table->getName()));
            $connection->query(sprintf('ALTER TABLE %s AUTO_INCREMENT = 1;', $table->getName()));
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        }
        catch (\Exception $e) {
            $connection->rollback();
        }
    }

    /**
     * Executa Truncate em todas tabelas da database descrita em global.php
     */
    public function autoincrementDatabase()
    {
        $schema = $this->getSchema();

        $tables = $schema->getTables();

        foreach ($tables as $table) {
            $this->truncate($table);
        }

        return true;
    }

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

                //var_dump($constraint->getReferencedTableName());
                if ($constraint->getReferencedTableName() != $name) {
                    $this->getConstraintsByName($constraint->getReferencedTableName());
                }
            }
        }
    }

    public function createBorder()
    {
        foreach ($this->tables as $name => $table) {

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


    public function getTableObjectToRow(TableObject $tableObject)
    {
        $db = $this->injectDbWithTable($tableObject);

        $tableValidation = new \Gear\Service\Db\TableValidation($tableObject);

        if ($this->validatePrimaryKey($db)) {
            $statusPrimary = 'ok';
        } else {
            $statusPrimary = 'fix';
        }
        $text = "1";
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

    public function dropSystematicColumns(TableObject $table)
    {
        $table = $this->table($table->getName());

        if ($table->hasColumn('created')) {
            $this->outputConsole(sprintf('Dropping Column %s for %s', 'created', $table->getName()), 3);
            $this->dropCreated($table);

        } else {
            $this->outputConsole(sprintf('Column %s was dropped already from %s', 'created', $table->getName()), 2);
        }

        if ($table->hasColumn('updated')) {
             $this->outputConsole(sprintf('Dropping Column %s for %s', 'updated', $table->getName()), 3);
             $this->dropUpdated($table);

        } else {
            $this->outputConsole(sprintf('Column %s was dropped already from %s', 'updated', $table->getName()), 2);
        }

        if ($table->hasColumn('created_by')) {
             $this->outputConsole(sprintf('Dropping Column %s for %s', 'created_by', $table->getName()), 3);
             $this->dropCreatedBy($table);

        } else {
            $this->outputConsole(sprintf('Column %s was dropped already from %s', 'created_by', $table->getName()), 2);
        }

        if ($table->hasColumn('updated_by')) {
            $this->outputConsole(sprintf('Dropping Column %s for %s', 'updated_by', $table->getName()), 3);
            $this->dropUpdatedBy($table);

        } else {
            $this->outputConsole(sprintf('Column %s was dropped already from %s', 'updated_by', $table->getName()), 2);
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


    public function doAnalyseTable($tableName)
    {
        $table = $this->getSchema()->getTable($this->str('uline', $tableName));
        $tableValidation = new \Gear\Service\Db\TableValidation($table);
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

        foreach ($tables as $i => $table) {
            $tableScreen->appendRow($this->getTableObjectToRow($table));
            static::$rowCount += 1;
        }

        echo $tableScreen;
    }

    /**
     * @param Gear\ValueObject\Db $db
     */
    public function fixPrimaryKey($db)
    {
        return;
    }

    public function fixTable($tableName)
    {

        $schema = $this->getSchema();

        $table = $schema->getTable($this->str('uline', $tableName));

        $this->executeFix($table);

        return true;
    }

    public function executeFix(TableObject $tableObject)
    {
        $tableValidation = new \Gear\Service\Db\TableValidation($tableObject);

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
     * @param Gear\ValueObject\Db $db
     * @return boolean
     */
    public function validatePrimaryKey($db)
    {
        $actualPrimaryKey = '';
        try {
            $actualPrimaryKey = $db->getPrimaryKeyColumnName();
        } catch(\Exception $e) {
            $actualPrimaryKey = false;
        }

        if ($db->getTable() != 'user_role_linker') {
            $namePrimaryToCompare = 'id_'.$this->str('uline', $db->getTable());
        } else {
            $namePrimaryToCompare = 'id_user,id_role';
        }


        if ($actualPrimaryKey == $namePrimaryToCompare) {
            $statusPrimary =  true;
        } else {
            $statusPrimary = false;
        }

        return $statusPrimary;
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

        if ($table->hasColumn('created')) {
            $table->removeColumn('created');
            $table->update();
        }

        $table->addColumn('created', 'datetime', array('null' => false));
        $table->update();
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

        $table->addColumn('created_by', 'integer', array_merge(array('limit' => 1), $options))
        ->addForeignKey('created_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->update();
        echo sprintf('Criado %s', 'created_by')."\n";
    }

    /**
     *
     * @param Zend\Db\Metadata\TableObject $table
     * @return \Gear\ValueObject\Db
     */
    public function injectDbWithTable($table)
    {
        $data = array(
            'table' => $this->str('uline', $table->getName()),
            'tableObject' => $table,
            'columns' => array()
        );

        $db = new \Gear\ValueObject\Db($data);
        return $db;
    }

    public function getTextTable()
    {
        $tableScreen = new \Zend\Text\Table\Table(array('columnWidths' => array(10, 20, 30, 15, 20, 20, 20, 20)));
        // Either simple
        $tableScreen->appendRow(array('Id', 'Name', 'PrimaryKeyName', 'PrimaryStatus', 'Created Time', 'Created By', 'Updated Time', 'Updated By'));

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
     * @param Gear\ValueObject\Db $db
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


}
