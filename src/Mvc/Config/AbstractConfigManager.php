<?php
namespace Gear\Mvc\Config;

//use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\AbstractConfigManagerInterface;
use Gear\Creator\CodeTrait;
//use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;

class AbstractConfigManager
{
    use ModuleStructureTrait;

    use FileCreatorTrait;

    use StringServiceTrait;

    use CodeTrait;

    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $string
    ) {
        $this->setModule($module);
        $this->setFileCreator($fileCreator);
        $this->setStringService($string);
    }
}
