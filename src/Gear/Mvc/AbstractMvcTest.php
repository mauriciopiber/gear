<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\CodeTestTrait;
use Gear\Column\Int\PrimaryKey;
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
