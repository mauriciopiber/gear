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
use Gear\Service\Column\Int\PrimaryKey;
use Gear\Service\Column\Int\ForeignKey;
use Gear\Service\Column\Date;
use Gear\Service\Column\Datetime;
use Gear\Service\Column\Time;
use Gear\Service\Column\AbstractDateTime;
use Gear\Service\Column\Decimal;
use Gear\Service\Column\Int;
use Gear\Service\Column\TinyInt;
use Gear\Service\Column\Varchar;
use Gear\Service\Column\Text;
use Gear\Service\Column\Varchar\Email;
use Gear\Service\Column\Varchar\UploadImage;

abstract class AbstractFixtureService extends AbstractJsonService
{
    protected $validColumns;
    protected $usePrimaryKey;
    protected $baseArray;
    protected $primaryKey;

    protected $columnStack;

    public function getSelectOneByForUnitTest()
    {
        $selectOneBy = [***REMOVED***;
        //get order
        foreach ($this->getTableData() as $columnData) {

            if (in_array(get_class($columnData), array(
            	'Gear\Service\Column\Varchar\PasswordVerify',
                'Gear\Service\Column\Varchar\UniqueId',
            ))) {
                continue;
            }

            $baseColumn = array_merge(
                $this->getBaseArray(),
                [
                    'var' => $this->str('var', $columnData->getColumn()->getName()),
                    'class' => $this->str('class', $columnData->getColumn()->getName())
                ***REMOVED***
            );

            if ($columnData instanceof \Gear\Service\Column\Varchar\UploadImage) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array('value' => '\''.$columnData->selectOneBy(15).'\''));
                continue;
            }

            if ($columnData instanceof PrimaryKey) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
                continue;
            }

            if ($columnData instanceof PrimaryKey) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
                continue;
            }

            if ($columnData instanceof Email) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array('value' => sprintf('%s', $columnData->getFixtureFormat(15))));
                continue;
            }


            if ($columnData instanceof Varchar || $columnData instanceof Text) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array('value' => '\''.$this->getBaseMessage('15', $columnData->getColumn(), false).'\''));
                continue;
            }


        }

        return $selectOneBy;
    }

    public function getOrderByForUnitTest()
    {

        $order = [***REMOVED***;
        //get order
        foreach ($this->getTableData() as $columnData) {

            if (in_array(get_class($columnData), array(
                'Gear\Service\Column\Varchar\PasswordVerify',
                'Gear\Service\Column\Varchar\UniqueId',
            ))) {
                continue;
            }


            $baseColumn = array_merge(
                $this->getBaseArray(),
                [
                    'var' => $this->str('var', $columnData->getColumn()->getName()),
                    'class' => $this->str('class', $columnData->getColumn()->getName()),
                    'fixtureSize' => $this->getFixtureSizeByTableName()
                ***REMOVED***
            );

            if ($columnData instanceof PrimaryKey) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$this->getBaseMessage(1, $columnData->getColumn(), false, true).'\''
                    )
                );

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$this->getBaseMessage(30, $columnData->getColumn(), false, true).'\''
                    )
                );
                continue;
            }


            if ($columnData instanceof Email) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => $columnData->getFixtureFormat(1)
                    )
                );

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => $columnData->getFixtureFormat(30)
                    )
                );
                continue;
            }

            if ($columnData instanceof \Gear\Service\Column\Varchar\UploadImage) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$columnData->getOrderBy(1).'\''
                    )
                );

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$columnData->getOrderBy(30).'\''
                    )
                );
                continue;
            }

            if ($columnData instanceof Varchar || $columnData instanceof Text) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$this->getBaseMessage(1, $columnData->getColumn(), false, false).'\''
                    )
                );

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$this->getBaseMessage(30, $columnData->getColumn(), false, false).'\''
                    )
                );
                continue;
            }





        }

        return $order;
    }

    /**
     * Usado em RepositoryTest, ServiceTest, ControllerTest
     * @return \Gear\ValueObject\Structure\UnitTestValues
     */


    public function getValuesForUnitTest()
    {
        $data = $this->getTableData();
        $insertSelect = [***REMOVED***;
        foreach ($data as $i => $columnData) {

            if ($this->isClass($columnData, 'Gear\Service\Column\Varchar\UploadImage')) {

                if (isset($this->repository) && $this->repository === true) {
                    $insertData[***REMOVED***   = $columnData->getInsertDataRepositoryTest();
                    $insertAssert[***REMOVED*** = $columnData->getInsertAssertRepositoryTest();
                    $updateData[***REMOVED***   = $columnData->getUpdateDataRepositoryTest();
                    $updateAssert[***REMOVED*** = $columnData->getUpdateAssertRepositoryTest();
                } else {
                    $insertData[***REMOVED***  = $columnData->getInsertArrayByColumn();
                    $insertAssert[***REMOVED*** = $columnData->getInsertAssertByColumn();
                    $insertSelect[***REMOVED*** = $columnData->getInsertSelectByColumn();
                    $updateData[***REMOVED***  = $columnData->getUpdateArrayByColumn();
                    $updateAssert[***REMOVED*** = $columnData->getUpdateAssertByColumn();

                    $insertAssert[***REMOVED*** = $columnData->getInsertFileExistsTest();
                    $updateAssert[***REMOVED*** = $columnData->getUpdateFileExistsTest();
                }

                continue;

            }

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {
                $columnData->setHelperStack([
            	    'insert' => rand(1, 30),
            	    'update' => rand(1, 30)
                ***REMOVED***);
            }

            if ($columnData instanceof AbstractDateTime) {
                $timeInsert = new \DateTime('now');

                $timeInsert->add(new \DateInterval(sprintf('P%dD', rand(1,9999))));

                $columnData->setInsertTime($timeInsert);

                $timeInsert->add(new \DateInterval('P1M'));
                $columnData->setUpdateTime($timeInsert);
            }

            if ($columnData instanceof Decimal) {
                $columnData->setReference(rand(50,5000));
            }

            if ($columnData instanceof Int || $columnData instanceof TinyInt) {
                $columnData->setReference(rand(1,99999));
            }


            if ($columnData instanceof Varchar) {
                $columnData->setReference(rand(50,5000));
            }

            //Quebra necessária, os password verify não tem como serem testados!
            if ($this->isClass($columnData, 'Gear\Service\Column\Varchar\PasswordVerify')) {
                //$updateData[***REMOVED***  = $columnData->getVerifyUpdateColumn();
                //$insertData[***REMOVED***  = $columnData->getVerifyInsertColumn();
                continue;
            } elseif($this->isclass($columnData, 'Gear\Service\Column\Varchar\UniqueId')) {
                continue;
            }
            $insertData[***REMOVED***  = $columnData->getInsertArrayByColumn();
            $insertAssert[***REMOVED*** = $columnData->getInsertAssertByColumn();
            $insertSelect[***REMOVED*** = $columnData->getInsertSelectByColumn();

            if ($columnData instanceof AbstractDateTime) {
                $timeInsert->add(new \DateInterval('P2M'));
                $columnData->setUpdateTime($timeInsert);
            }


            $updateData[***REMOVED***  = $columnData->getUpdateArrayByColumn();
            $updateAssert[***REMOVED*** = $columnData->getUpdateAssertByColumn();

            continue;

        }

        $unitTestValues = new \Gear\ValueObject\Structure\UnitTestValues();
        $unitTestValues->setInsertArray($insertData);
        $unitTestValues->setInsertSelect($insertSelect);
        $unitTestValues->setInsertAssert($insertAssert);
        $unitTestValues->setUpdateArray($updateData);
        $unitTestValues->setUpdateAssert($updateAssert);
        return $unitTestValues;
    }

    public function isClass($columnData, $class)
    {
        return in_array(
            get_class($columnData),
            array($class)
        );
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

    public function getBaseMessage($base, $column, $whitespace = false, $isPrimaryKey = false)
    {
        if ($whitespace) {
            $data = '%s %s';
        } else {
            $data = '%s%s';
        }

        $base = sprintf('%02d', $base);

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

	public function getBaseArray() {
		return $this->baseArray;
	}

	public function setBaseArray($baseArray) {
		$this->baseArray = $baseArray;
		return $this;
	}


}
