<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\CodeTestTrait;
use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;
use Gear\Creator\FileCreator\AppTest\VarsTrait;
//use GearJson\Src\Src;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\TraitTestServiceTrait;
use Gear\Creator\Injector\InjectorTrait;
use Gear\Util\GearVersionTrait;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\Src as SrcObject;
use GearJson\Db\Db as DbObject;

abstract class AbstractMvcTest extends AbstractJsonService
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
