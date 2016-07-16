<?php
namespace Gear\Edge;

use Gear\Service\AbstractJsonService;

abstract class AbstractEdge extends AbstractJsonService
{
    static protected $moduleDir = 'data/edge-technologic/module';

    static protected $projectDir = 'data/edge-technologic/project';

    public function getModuleLocation($type)
    {
        $dir = (new \Gear\Module)->getLocation().'/../../'.static::$moduleDir.'/'.$type;

        if ($type === null || !is_dir($dir)) {
            throw new \Gear\Edge\Exception\ModuleTypeNotFoundException();
        }

        return $dir;
    }

    public function getProjectLocation($type)
    {
        $dir = (new \Gear\Module)->getLocation().'/../../'.static::$projectDir.'/'.$type;

        if ($type === null || !is_dir($dir)) {
            throw new \Gear\Edge\Exception\ProjectTypeNotFoundException();
        }

        return $dir;
    }
}
