<?php
namespace Gear\Edge;

use Gear\Util\Yaml\YamlService;
use Gear\Util\Yaml\YamlServiceTrait;

abstract class AbstractEdge implements AbstractEdgeInterface
{
    protected static $moduleDir = 'data/edge-technologic/module';

    use YamlServiceTrait;

    public function __construct(
        YamlService $yaml
    ) {
        $this->setYamlService($yaml);
    }

    public function getModuleLocation($type)
    {
        $dir = (new \Gear\Module)->getLocation().'/../'.static::$moduleDir.'/'.$type;

        if ($type === null || !is_dir($dir)) {
            throw new \Gear\Edge\Exception\ModuleTypeNotFoundException();
        }

        return $dir;
    }
}
