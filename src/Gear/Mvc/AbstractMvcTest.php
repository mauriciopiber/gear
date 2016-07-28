<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
//use Gear\Creator\FileNamespaceInterface;
//use Gear\Creator\FileLocationInterface;
//use Gear\Creator\FileTestNamespaceInterface;
use Gear\Creator\CodeTestTrait;
use Gear\Column\Int\PrimaryKey;
//use Gear\Column\Int\ForeignKey;
//use Gear\Column\Date\Date;
//use Gear\Column\Datetime\Datetime;
//use Gear\Column\Time\Time;
//use Gear\Column\AbstractDateTime;
//use Gear\Column\Decimal\Detimal;
//use Gear\Column\Int\Int;
//use Gear\Column\TinyInt\TinyInt;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Text\Text;
use Gear\Column\Varchar\Email;
use Gear\Column\Varchar\UploadImage;
use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;
use Gear\Creator\FileCreator\AppTest\VarsTrait;
//use GearJson\Src\Src;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\TraitTestServiceTrait;
use Gear\Creator\File\InjectorTrait;
use Gear\Util\GearVersionTrait;
use GearJson\Schema\SchemaServiceTrait;

abstract class AbstractMvcTest extends AbstractJsonService
{
    use SchemaServiceTrait;
    use GearVersionTrait;
    use InjectorTrait;
    use FactoryTestServiceTrait;
    use TraitTestServiceTrait;
    use CodeTestTrait;
    use BeforeEachTrait;
    use VarsTrait;

    static protected $factories = 'factories';

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
            if (in_array(get_class($columnData), [
                'Gear\Column\Varchar\PasswordVerify',
                'Gear\Column\Varchar\UniqueId',
            ***REMOVED***)) {
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
                        'value' => '\''.$columnData->getValueDatabase(1).'\''
                    )
                );

                $value = $columnData->getValueDatabase(30);


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

                $value = $columnData->getValueDatabase(1);


                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$value.'\''
                    )
                );

                $value = $columnData->getValueDatabase(30);


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
     * Cria os valores no padrão de inserção no banco por meio do Post do Controller/Service/Repository
     *
     * @param string $repository Repository
     *
     * @return string
     */
    public function insertArray($repository = false)
    {
        $code = '';

        foreach ($this->columns as $columnData) {
            if ($columnData instanceof PrimaryKey
            ) {
                continue;
            }

            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {
                if ($repository) {
                    $code .= $columnData->getInsertDataRepositoryTest();
                    continue;
                }
            }
            $this->createReference($columnData);

            $code .= $columnData->getInsertArrayByColumn();
        }


        $code = $this->formatCode($code);

        return $code;
    }

    public function getSelectOneByForUnitTest()
    {
        $selectOneBy = [***REMOVED***;
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
                    array('value' => '\''.$columnData->getValueDatabase(15).'\'')
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
