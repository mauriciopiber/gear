<?php
namespace Gear\Edge\Npm;

use Gear\Edge\AbstractEdge;

class NpmEdge extends AbstractEdge
{
    public function getNpmModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/npm.yml';

        return $this->getYamlService()->load($file);
    }
}
