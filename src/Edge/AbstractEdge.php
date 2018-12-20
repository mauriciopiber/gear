<?php
namespace Gear\Edge;

use Gear\Service\AbstractJsonService;
use Gear\Module;

abstract class AbstractEdge extends AbstractJsonService
{
    static protected $moduleDir = 'data/edge';

    public function getModuleLocation($type)
    {
        $dir = (new Module)->getLocation().'/../'.static::$moduleDir.'/'.$type;

        if ($type === null || !is_dir($dir)) {
            throw new \Gear\Edge\Exception\ModuleTypeNotFoundException();
        }

        return $dir;
    }
}
