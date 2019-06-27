<?php
namespace Gear\Mvc\Config;

//use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\AbstractConfigManagerInterface;
//use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Code\Code;
use Gear\Code\CodeTrait;
use Gear\Util\Vector\ArrayService;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Mvc\LanguageService;
use Gear\Mvc\LanguageServiceTrait;

class AbstractConfigManager
{
    use ArrayServiceTrait;

    use ModuleStructureTrait;

    use FileCreatorTrait;

    use StringServiceTrait;

    use CodeTrait;

    use LanguageServiceTrait;

    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $string,
        Code $code,
        ArrayService $arrayService,
        LanguageService $language
    ) {
        $this->setArrayService($arrayService);
        $this->setModule($module);
        $this->setFileCreator($fileCreator);
        $this->setStringService($string);
        $this->setCode($code);
        $this->setLanguageService($language);
    }
}
