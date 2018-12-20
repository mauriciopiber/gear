<?php
namespace Gear\Edge;

use Gear\Service\AbstractJsonService;
use Gear\Locator\ModuleLocatorTrait;

abstract class AbstractEdge extends AbstractJsonService
{
    use ModuleLocatorTrait;

    static protected $moduleDir = 'data/edge';

    public function getModuleLocation($type)
    {
        $dir = $this->getModuleFolder().'/'.static::$moduleDir.'/'.$type;

        if ($type === null || !is_dir($dir)) {
            throw new \Gear\Edge\Exception\ModuleTypeNotFoundException();
        }

        return $dir;
    }
}
