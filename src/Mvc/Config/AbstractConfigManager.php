<?php
namespace Gear\Mvc\Config;

//use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\AbstractConfigManagerInterface;
use Gear\Creator\CodeTrait;
//use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;

class AbstractConfigManager
{
    use ModuleStructureTrait;
    use CodeTrait;

    // public function __construct(
    //     ModuleStructure $module
    // ) {
    //     $this->setModule($module);
    // }
}
