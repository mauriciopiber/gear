<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\CodeTestTrait;
use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;
use Gear\Creator\FileCreator\AppTest\VarsTrait;
//use GearJson\Src\Src;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\TraitTestServiceTrait;
use Gear\Creator\File\InjectorTrait;
use Gear\Util\GearVersionTrait;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;

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

    static protected $factories = 'factories';
}
