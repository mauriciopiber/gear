<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Creator\FileTestNamespaceInterface;
use Gear\Creator\CodeTestTrait;
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
use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;
use Gear\Creator\FileCreator\AppTest\VarsTrait;
use GearJson\Src\Src;

abstract class AbstractMvcTest extends AbstractJsonService
{
    use CodeTestTrait;
    use BeforeEachTrait;
    use VarsTrait;

    public function getFixtureSize()
    {
        return array(
            'default' => 30,
            'User' => 37,
            'Role' => 32
        );
    }

    public function getFixtureSizeByTableName()
    {
        $size = $this->getFixtureSize();
        if (array_key_exists($this->tableName, $size)) {
            return $size[$this->tableName***REMOVED***;
        }
        return $size['default'***REMOVED***;
    }


    public function getOrderByForUnitTest()
    {

        $order = [***REMOVED***;
        //get order
        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {

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
