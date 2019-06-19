<?php
namespace Gear\Mvc;

use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;
use Gear\Creator\FileCreator\AppTest\VarsTrait;
//use Gear\Schema\Src\Src;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\TraitTestServiceTrait;
use Gear\Creator\Injector\InjectorTrait;
use Gear\Util\GearVersionTrait;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Schema\Src\Src as SrcObject;
use Gear\Schema\Db\Db as DbObject;
use Gear\Exception\InvalidArgumentException;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Creator\CodeTest;
use Gear\Creator\CodeTestTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Table\TableService\TableService;
use Gear\Table\TableService\TableServiceTrait;

abstract class AbstractMvcTest
{
    use ServiceManagerTrait;
    use SchemaServiceTrait;
    use GearVersionTrait;
    use InjectorTrait;
    use FactoryTestServiceTrait;
    use TraitTestServiceTrait;
    use CodeTestTrait;
    use BeforeEachTrait;
    use VarsTrait;
    use StringServiceTrait;
    use FileCreatorTrait;
    use ModuleStructureTrait;
    use TableServiceTrait;

    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $string,
        CodeTest $codeTest,
        TableService $tableService
    ) {
        $this->setTableService($tableService);
        $this->setCodeTest($codeTest);
        $this->setModule($module);
        $this->setFileCreator($fileCreator);
        $this->setStringService($string);
    }

    public function forceDbTest($data, $type)
    {
        if (($data instanceof DbObject) === false && ($data instanceof SrcObject && $data->getDb() != null) === false) {
            throw new InvalidArgumentException(sprintf('%s need a valid db', $type));
        }

        return $this->createTest($data, $type);
    }

    public function forceSrcTest($data, $type)
    {
        if (($data instanceof DbObject) || ($data instanceof SrcObject && $data->getDb() != null)) {
            throw new InvalidArgumentException(sprintf('%s need to be free from db', $type));
        }

        return $this->createTest($data, $type);
    }

    public function createTest($data, $type)
    {
        if ($data instanceof DbObject) {
            $this->db = $data;
            $this->src = $this->getSchemaService()->getSrcByDb($this->db, $type);
            return $this->createDbTest();
        }

        if ($data instanceof SrcObject && $data->getDb() instanceof DbObject) {
            $this->src = $data;
            $this->db = $this->src->getDb();
            return $this->createDbTest();
        }

        $this->src = $data;
        return $this->createSrcTest();
    }
}
