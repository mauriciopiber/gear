<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Creator\FileTestNamespaceInterface;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Int\ForeignKey;
use Gear\Column\Date;
use Gear\Column\Datetime;
use Gear\Column\Time;
use Gear\Column\AbstractDateTime;
use Gear\Column\Decimal;
use Gear\Column\Int;
use Gear\Column\TinyInt;
use Gear\Column\Varchar;
use Gear\Column\Text;
use Gear\Column\Varchar\Email;
use Gear\Column\Varchar\UploadImage;

abstract class AbstractMvcTest extends AbstractJsonService implements
    FileNamespaceInterface,
    FileTestNamespaceInterface,
    FileLocationInterface
{
    public function getTestNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = $data->getNamespace();
            return $namespace;
        }

        return str_replace('Test', '', static::$defaultNamespace);
    }

    public function getNamespace($data)
    {
        if (!empty($data->getNamespace())) {

            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $implode = implode('\\', $psr);

            $namespaceFile = $implode;

            $namespace = $data->getNamespace();

            return $namespace;
        }

        return static::$defaultNamespace;
    }

    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {

            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $location = $this->getModule()->getTestUnitModuleFolder().'/'.implode('/', $psr);

            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getTestUnitModuleFolder());
            $this->getDirService()->mkDir($location);

            return $location;
        }
        return $this->getModule()->map($data->getType().'Test');
    }


    public function getOrderByForUnitTest()
    {

        $order = [***REMOVED***;
        //get order
        foreach ($this->getTableData() as $columnData) {

            if (in_array(get_class($columnData), array(
                'Gear\Column\Varchar\PasswordVerify',
                'Gear\Column\Varchar\UniqueId',
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
                        'value' => '\''.$this->getTestBaseMessage(1, $columnData->getColumn(), false, true).'\''
                    )
                    );


                if ($columnData->getColumn()->getName() == 'id_user' && $this->tableName == 'User') {
                    $value = '37';
                } elseif ($columnData->getColumn()->getName() == 'id_role' && $this->tableName == 'Role') {
                    $value =  '32';
                } elseif ($columnData->getColumn()->getName() == 'id_role' && $this->tableName == 'User') {
                    $value = '37';
                } else {
                    $value = $this->getTestBaseMessage(30, $columnData->getColumn(), false, true);
                }

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$value.'\''
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

            if ($columnData instanceof \Gear\Column\Varchar\UploadImage) {

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

                /*
                 var_dump($columnData->getColumn()->getName());
                 var_dump($this->tableName);
                 */
                if ($columnData->getColumn()->getName() == 'username' && $this->tableName == 'User') {
                    $value = '';
                } else {
                    $value = $this->getTestBaseMessage(1, $columnData->getColumn(), false, false);
                }

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$value.'\''
                    )
                    );

                if ($columnData->getColumn()->getName() == 'email' && $this->tableName == 'User') {
                    $value = 'usuariogear6@gmail.com';
                } elseif ($columnData->getColumn()->getName() == 'name' && $this->tableName == 'Role') {
                    $value = 'guest';
                } elseif ($columnData->getColumn()->getName() == 'id_role' && $this->tableName == 'User') {
                    $value = 'guest';
                } else {
                    $value = $this->getTestBaseMessage(30, $columnData->getColumn(), false, false);
                }

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$value.'\''
                    )
                    );
                continue;
            }
        }

        return $order;
    }


    public function getValuesForUnitTest()
    {
        $this->static = '';
        $data = $this->getTableData();
        $insertSelect = [***REMOVED***;

        $insertData   = [***REMOVED***;
        $insertSelect = [***REMOVED***;
        $insertAssert = [***REMOVED***;
        $updateData   = [***REMOVED***;
        $updateAssert = [***REMOVED***;

        foreach ($data as $i => $columnData) {

            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {

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

                $this->static .= <<<EOS

    static public \${$this->str('var-lenght', $columnData->getColumn()->getName())} = '{$columnData->getUploadDir()}';

EOS;

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

                $timeInsert->add(new \DateInterval(sprintf('P%dD', rand(1, 9999))));

                $columnData->setInsertTime($timeInsert);

                $timeInsert->add(new \DateInterval('P1M'));
                $columnData->setUpdateTime($timeInsert);
            }

            if ($columnData instanceof Decimal) {
                $columnData->setReference(rand(50, 5000));
            }

            if ($columnData instanceof Int || $columnData instanceof TinyInt) {
                $columnData->setReference(rand(1, 99999));
            }


            if ($columnData instanceof Varchar) {
                $columnData->setReference(rand(50, 5000));
            }

            //Quebra necessária, os password verify não tem como serem testados!
            if ($this->isClass($columnData, 'Gear\Column\Varchar\PasswordVerify')) {

                $updateData[***REMOVED***  = $columnData->getVerifyUpdateColumn();
                $updateData[***REMOVED***  = $columnData->getVerifyVerifyUpdateColumn();
                $insertData[***REMOVED***  = $columnData->getVerifyInsertColumn();
                $insertData[***REMOVED***  = $columnData->getVerifyVerifyInsertColumn();

                continue;
            } elseif ($this->isclass($columnData, 'Gear\Column\Varchar\UniqueId')) {


                if (isset($this->repository) && $this->repository === true) {
                    $insertData[***REMOVED***  = $columnData->getInsertArrayByColumn();
                    $updateData[***REMOVED***  = $columnData->getUpdateArrayByColumn();
                }
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

        $unitTestValues = new \Gear\Mvc\UnitTestValues();
        $unitTestValues->setInsertArray($insertData);
        $unitTestValues->setInsertSelect($insertSelect);
        $unitTestValues->setInsertAssert($insertAssert);
        $unitTestValues->setUpdateArray($updateData);
        $unitTestValues->setUpdateAssert($updateAssert);

        return $unitTestValues;
    }



    /**
     * @deprecated
     */
    public function getTestBaseMessage($base, $column, $whitespace = false, $isPrimaryKey = false)
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


    public function getSelectOneByForUnitTest()
    {
        $selectOneBy = [***REMOVED***;
        //get order
        foreach ($this->getTableData() as $columnData) {

            if (in_array(get_class($columnData), array(
                'Gear\Column\Varchar\PasswordVerify',
                'Gear\Column\Varchar\UniqueId',
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


            if ($columnData instanceof \Gear\Column\Varchar\UploadImage) {
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
                $selectOneBy[***REMOVED*** = array_merge(
                    $baseColumn,
                    array('value' => sprintf('%s', $columnData->getFixtureFormat(15)))
                    );
                continue;
            }


            if ($columnData instanceof Varchar || $columnData instanceof Text) {
                $selectOneBy[***REMOVED*** = array_merge(
                    $baseColumn,
                    array('value' => '\''.$this->getTestBaseMessage('15', $columnData->getColumn(), false).'\'')
                    );
                continue;
            }


        }

        return $selectOneBy;
    }

    public function getBaseArray()
    {
        return $this->baseArray;
    }

    public function setBaseArray($baseArray)
    {
        $this->baseArray = $baseArray;
        return $this;
    }
}
