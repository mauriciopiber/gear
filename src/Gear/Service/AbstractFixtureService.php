<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Gear\Metadata\Table;

abstract class AbstractFixtureService extends AbstractJsonService
{
    protected $tableName;
    protected $tableColumns;
    protected $validColumns;
    protected $usePrimaryKey;
    protected $baseArray;
    protected $primaryKey;

    protected $columnStack;


    public function loadTable($table)
    {

        if ($table instanceof \Gear\ValueObject\Db) {
            $name = $table->getTable();
        } elseif ($table instanceof \Gear\ValueObject\Src) {
            $name = $table->getName();
        } elseif ($table instanceof \Zend\Db\Metadata\Object\TableObject) {
            $name = $table->getName();
        }

        $this->tableName    = $this->str('class', $name);
        $metadata           = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->table        = new Table($metadata->getTable($this->str('uline', $this->tableName)));
        $this->primaryKey   = $this->table->getPrimaryKeyColumns();
    }

    public function getSelectOneByForUnitTest()
    {
        $selectOneBy = [***REMOVED***;
        //get order
        foreach ($this->getValidColumnsFromTable() as $column) {

            $baseColumn = array_merge($this->getBaseArray(), ['var' => $this->str('var', $column->getName()), 'class' => $this->str('class', $column->getName())***REMOVED***);


            if (in_array($column->getName(), $this->primaryKey)) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
            }

            if (in_array($column->getDataType(), array('text', 'varchar'))) {

                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array('value' => '\''.$this->getBaseMessage('15', $column, false).'\''));
            }
        }

        return $selectOneBy;
    }

    public function getOrderByForUnitTest()
    {
        $primaryKeyColumn   = $this->table->getPrimaryKeyColumns();

        $order = [***REMOVED***;
        //get order
        foreach ($this->getValidColumnsFromTable() as $column) {
            $baseColumn = array_merge(
                $this->getBaseArray(),
                [
                    'var' => $this->str('var', $column->getName()),
                    'class' => $this->str('class', $column->getName())
                ***REMOVED***
            );

            if (in_array($column->getName(), $primaryKeyColumn)) {
                $labelAsc = 1;
                $labelDesc = 30;
                $order[***REMOVED*** = array_merge($baseColumn, array('order' => 'ASC', 'value' => '\''.$this->getBaseMessage($labelAsc, $column, false, true).'\''));
                $order[***REMOVED*** = array_merge($baseColumn, array('order' => 'DESC', 'value' => '\''.$this->getBaseMessage($labelDesc, $column, false, true).'\''));
            }

            if (in_array($column->getDataType(), array('text', 'varchar'))) {
                $labelAsc = 10;
                $labelDesc = 9;
                $order[***REMOVED*** = array_merge($baseColumn, array('order' => 'ASC', 'value' => '\''.$this->getBaseMessage($labelAsc, $column, false, false).'\''));
                $order[***REMOVED*** = array_merge($baseColumn, array('order' => 'DESC', 'value' => '\''.$this->getBaseMessage($labelDesc, $column, false, false).'\''));
            }


        }

        return $order;
    }

    public function getValuesForUnitTest()
    {

        $valueToInsertArray = [***REMOVED***;
        $valueToInsertAssert = [***REMOVED***;
        $valueToUpdateArray = [***REMOVED***;
        $valueToUpdateAssert = [***REMOVED***;

        foreach ($this->getValidColumnsFromTable() as $column) {

            unset($this->columnStack);

            if (in_array($column->getDataType(), array('text', 'varchar'))) {
                $valueToInsertArray[***REMOVED*** = $this->getInsertArrayByColumn($column);
                $valueToInsertAssert[***REMOVED*** = $this->getInsertAssertByColumn($column);
                $valueToUpdateArray[***REMOVED*** = $this->getUpdateArrayByColumn($column);
                $valueToUpdateAssert[***REMOVED*** = $this->getUpdateAssertByColumn($column);
            }

            if ($columnConstraint = $this->table->getForeignKeyFromColumn($column)) {


                $this->columnStack = [
            	    'insert' => rand(1, 30),
            	    'update' => rand(1, 30)
                ***REMOVED***;

                $valueToInsertArray[***REMOVED*** = $this->getInsertArrayByColumnForeignKey($column);
                $valueToInsertAssert[***REMOVED*** = $this->getInsertAssertByColumnForeignKey($column);
                $valueToUpdateArray[***REMOVED*** = $this->getUpdateArrayByColumnForeignKey($column);
                $valueToUpdateAssert[***REMOVED*** = $this->getUpdateAssertByColumnForeignKey($column);


            }


        }

        $unitTestValues = new \Gear\ValueObject\Structure\UnitTestValues();
        $unitTestValues->setInsertArray($valueToInsertArray);
        $unitTestValues->setUpdateArray($valueToUpdateArray);
        $unitTestValues->setInsertAssert($valueToInsertAssert);
        $unitTestValues->setUpdateAssert($valueToUpdateAssert);
        return $unitTestValues;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumnForeignKey($column)
    {
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%d\','.PHP_EOL,
            $this->str('var', $column->getName()),
            $this->columnStack['insert'***REMOVED***
        );

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumnForeignKey($column)
    {
        $insertAssert = '        ';

        $insertAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->get%s());'.PHP_EOL,
            $this->columnStack['insert'***REMOVED***,
            $this->str('class', $column->getName()),
            $this->str('class', $column->getName())
        );

        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumnForeignKey($column)
    {
        $update = '            ';
        $update .= sprintf(
            '\'%s\' => \'%s\','.PHP_EOL,
            $this->str('var', $column->getName()),
            $this->columnStack['update'***REMOVED***
        );
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumnForeignKey($column)
    {
        $updateAssert = '        ';
        $updateAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->get%s());'.PHP_EOL,
            $this->columnStack['update'***REMOVED***,
            $this->str('class', $column->getName()),
            $this->str('class', $column->getName())
        );
        return $updateAssert;
    }

    public function getValidColumnsFromTable()
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $primaryKeyColumn = $table->getPrimaryKeyColumns();

        unset($this->validColumns);

        foreach ($this->tableColumns as $column) {


            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {

                if (!$this->usePrimaryKey) {
                    continue;
                }
            }

            if (in_array($column->getName(), \Gear\ValueObject\Db::excludeList())) {
                continue;
            }

            $columnConstraint = $table->getForeignKeyFromColumn($column);


       /*      if ($columnConstraint && $column->isNullable()) {
                continue;
            } else {
                $this->validColumns[***REMOVED***  = $column;
                continue;
                //create a getReference using getOrder.
            } */

            $this->validColumns[***REMOVED***  = $column;
        }
        return $this->validColumns;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn($column)
    {
        $insert = '            ';
        $insert .= sprintf('\'%s\' => \'%s\','.PHP_EOL, $this->str('var', $column->getName()), $this->getBaseMessage('insert', $column));

        return $insert;
    }

    public function getBaseMessage($base, $column, $whitespace = false, $isPrimaryKey = false)
    {
        if ($whitespace) {
            $data = '%s %s';
        } else {
            $data = '%s%s';
        }

        if ($isPrimaryKey) {
            $baseMessage = $base;
        } else {
            $baseMessage = sprintf($data, $base, $this->str('label', $column->getName()));
        }

        if (strlen($baseMessage) > $column->getCharacterMaximumLength() && $column->getDataType() == 'varchar') {
            $baseMessage = substr($baseMessage, 0, $column->getCharacterMaximumLength());
        }
        return $baseMessage;
    }
    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn($column)
    {
        $insertAssert = '        ';
        $insertAssert .= sprintf('$this->assertEquals(\'%s\', $resultSet->get%s());'.PHP_EOL, $this->getBaseMessage('insert', $column), $this->str('class', $column->getName()));

        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn($column)
    {
        $update = '            ';
        $update .= sprintf('\'%s\' => \'%s\','.PHP_EOL, $this->str('var', $column->getName()), $this->getBaseMessage('update', $column));
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn($column)
    {
        $updateAssert = '        ';
        $updateAssert .= sprintf('$this->assertEquals(\'%s\', $resultSet->get%s());'.PHP_EOL, $this->getBaseMessage('update', $column), $this->str('class', $column->getName()));
        return $updateAssert;
    }

	public function getBaseArray() {
		return $this->baseArray;
	}

	public function setBaseArray($baseArray) {
		$this->baseArray = $baseArray;
		return $this;
	}


}
