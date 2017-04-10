<?php
namespace Gear\Database;

use Zend\Db\Metadata\Object\TableObject;
use Gear\Database\TableValidation;
use Gear\Database\AutoincrementServiceTrait;
use Gear\Database\Connector\DbConnector\DbConnectorTrait;
use Gear\Database\Connector\PhinxConnector\PhinxConnectorTrait;
use Gear\Table\TableService\TableServiceTrait;
use Zend\Db\Sql\Update;
use Zend\Text\Table\Column;

class SchemaToolService extends DbAbstractService
{
    use AutoincrementServiceTrait;

    use DbConnectorTrait;

    use PhinxConnectorTrait;

    protected static $rowCount = 1;

    public function notifyDropColumn($name, $table)
    {
        $this->getServiceLocator()
            ->get('console')
            ->writeLine(sprintf('Dropping Column %s for %s', $name, $table->getName()), 3);
    }

    public function notifyColumnAlreadyDrop($name, $table)
    {
        $this->getServiceLocator()
            ->get('console')
            ->writeLine(sprintf('Column %s was dropped already from %s', $name, $table->getName()), 2);
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


        $this->dropTable('phinxlog');

        return true;
    }

    public function except()
    {
        return ['migrations', 'phinxlog'***REMOVED***;
    }

    public function executeFix(TableObject $tableObject)
    {
        // Caso seja uma tabela exceptional que não deve ser alterada, volta.
        if (in_array($tableObject->getName(), $this->except())) {
            return true;
        }

        $tableValidation = new TableValidation($tableObject);

        $noTruncate = $this->getRequest()->getParam('no-truncate', false);


        if ($noTruncate === false) {
            $this->getAutoincrementService()->truncate($tableObject);
        }

        if (!$this->validatePrimaryKey($tableObject->getName())) {
            $this->fixPrimaryKey($tableObject->getName());
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

        return true;
    }

    /**
     * Corrige o banco de dados
     */
    public function fixDatabase()
    {
        $schema = $this->getSchema();

        $tables = $schema->getTables();

        foreach ($tables as $table) {
            $this->executeFix($table);
        }

        $this->dropTable('phinxlog');
    }

    public function dropTable($tableName)
    {
        $adapter = $this->getPhinxConnector()->getAdapter();
        if ($adapter->hasTable($tableName)) {
            $table = $this->getPhinxConnector()->getTable($tableName);
            $table->drop();
        }

        $adapter->disconnect();
    }

    /**
     *
     * @param GearJson\Db\Db $db
     * @return boolean
     */
    public function validatePrimaryKey($tableName)
    {
        $actualPrimaryKey = '';

        try {
            $actualPrimaryKey = $this->getPrimaryKeyColumnName($tableName);
        } catch (\Exception $e) {
            $actualPrimaryKey = false;
        }

        $namePrimaryToCompare = sprintf('id_%s', $this->str('uline', $tableName));

        $statusPrimary = ($actualPrimaryKey == $namePrimaryToCompare);

        return $statusPrimary;
    }

    /**
     * @param GearJson\Db\Db $db
     */
    public function fixPrimaryKey($tableName)
    {
        $namePrimaryToCompare = 'id_'.$this->str('uline', $tableName);

        $table = $this->getPhinxConnector()->getTable($tableName);

        if (false === $table->hasColumn($namePrimaryToCompare)) {
            $sql = sprintf(
                'ALTER TABLE %s ADD %s INT PRIMARY KEY AUTO_INCREMENT;',
                $tableName,
                $namePrimaryToCompare
            );
            $this->getDbConnector()->query($sql);
            $this->getDbConnector()->disconnect();
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
        $table = $this->getPhinxConnector()->getTable($name);

        $this->dropColumn($table, 'created', false);

        $table->addColumn('created', 'datetime', array('null' => false));
        $table->update();
        $this->updateReference(
            $name,
            [
                'created' => (new \DateTime('now'))->format('Y-m-d H:i:s')
            ***REMOVED***
        );

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
        $table = $this->getPhinxConnector()->getTable($name);

        $this->dropColumn($table, 'updated', false);

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

        $table = $this->getPhinxConnector()->getTable($name);

        $this->dropColumn($table, 'updated_by', true);

        $table->addColumn('updated_by', 'integer', array('limit' => 1, 'null' => true))
        ->addForeignKey('updated_by', 'user', 'id_user', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->update();
        echo sprintf('Criado %s', 'updated_by')."\n";
    }

    public function dropColumn($table, $name, $foreignKey = false)
    {
        if ($table->hasColumn($name)) {
            if ($foreignKey) {
                $table->dropForeignKey($name);
            }
            $table->removeColumn($name);
            $table->update();
        }
    }

    /**
     * @param string $name Nome da Tabela
     */
    public function createCreatedBy($name)
    {
        if ($name == 'user_role_linker') {
            return;
        }
        $table = $this->getPhinxConnector()->getTable($name);

        $this->dropColumn($table, 'created_by', true);

        $options = ($name == 'user') ? array('null' => true) : array('null' => false);

        $table->addColumn('created_by', 'integer', array_merge(array('limit' => 1), $options));

        $tableHasData = $this->tableHasData($name);

        if ($tableHasData) {
            $table->update();
            $this->updateReference($name, [
                'created_by' => 1
            ***REMOVED***);
        }

        $this->addForeignKey($table, 'created_by', 'user', 'id_user');

        $this->notifyCreated('created_by');
    }

    public function notifyCreated($columnName)
    {
        $this->getServiceLocator()->get('console')->writeLine(sprintf('Criado %s', $columnName));
    }

    public function addForeignKey($table, $column, $tableReference, $reference)
    {
        $table->addForeignKey($column, $tableReference, $reference, array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->update();
    }

    public function tableHasData($tableName)
    {
        $select = new \Zend\Db\Sql\Select();
        $select->from($tableName);

        $data = $this->getDbConnector()->select($select);

        if ($data->count() >= 1) {
            return true;
        }

        return false;
    }

    public function updateReference($tableName, $where)
    {
        $update = new Update($tableName);
        $update->set($where);

        $primaryKey = 'id_'.$this->str('uline', $tableName);


        $update->where(function ($where) use ($primaryKey) {
            $where->isNotNull($primaryKey);
        });

        return $this->getDbConnector()->update($update);
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


    /**
     * Retorna exclusivamente o nome da Coluna em uma String. Chaves compostas vem divididas com ",".
     *
     * @param string $tableName Table Name
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getPrimaryKeyColumnName($tableName)
    {
        $table = $this->getSchema()->getTable($this->str('uline', $tableName));

        if ($table) {
            $contraints = $table->getConstraints();

            foreach ($contraints as $contraint) {
                if ($contraint->getType() == 'PRIMARY KEY') {
                    $columns = $contraint->getColumns();

                    $column = implode(',', $columns);

                    return $column;
                } else {
                    continue;
                }
            }
        }

        throw new \Exception(sprintf('Tabela %s não possui Primary Key', $this->table));
    }


    public function getTableObjectToRow(TableObject $tableObject)
    {
        $tableValidation = new TableValidation($tableObject);

        if ($this->validatePrimaryKey($tableObject->getName())) {
            $statusPrimary = 'ok';
        } else {
            $statusPrimary = 'fix';
        }

        // Or verbose
        $row = new \Zend\Text\Table\Row();
        $row->appendColumn(new Column("".static::$rowCount));
        $row->appendColumn(new Column($this->str('label', $tableObject->getName())));
        $row->appendColumn(new Column($this->getPrimaryKeyColumnName($tableObject->getName())));
        $row->appendColumn(new Column($statusPrimary));
        $row->appendColumn(new Column($tableValidation->getCreated()));
        $row->appendColumn(new Column($tableValidation->getCreatedBy()));
        $row->appendColumn(new Column($tableValidation->getUpdated()));
        $row->appendColumn(new Column($tableValidation->getUpdatedBy()));

        return $row;
    }

    public function verifyAndDrop($table, $column, $foreignKey)
    {
        if ($table->hasColumn($column)) {
            $this->notifyDropColumn($column, $table);
            $this->dropColumn($table, $column, $foreignKey);
            return true;
        }

        return false;
    }


    public function dropSystematicColumns(TableObject $table)
    {
        $table = $this->getPhinxConnector()->getTable($table->getName());

        $this->verifyAndDrop($table, 'created', false);
        $this->verifyAndDrop($table, 'updated', false);
        $this->verifyAndDrop($table, 'created_by', true);
        $this->verifyAndDrop($table, 'updated_by', true);

        return true;
    }

    public function printTableStatus($table)
    {
        $tableScreen = $this->getTextTable();
        $tableScreen->appendRow($this->getTableObjectToRow($table));
        echo $tableScreen;
    }

    public function clearTable($tableName)
    {
        $table = $this->getSchema()->getTable($this->str('uline', $tableName));

        $this->printTableStatus($table);

        $this->dropSystematicColumns($table);

        $this->printTableStatus($table);
    }
}
