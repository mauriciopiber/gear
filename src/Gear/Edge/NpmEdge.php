<?php
namespace Gear\Edge;

use Gear\Edge\AbstractEdge;

class NpmEdge extends AbstractEdge
{
    public function getNpmModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/npm.yml';

        return $this->getYamlService()->load($file);

    }

    public function getNpmProject($type = 'web')
    {
        $file = $this->getProjectLocation($type).'/npm.yml';

        return $this->getYamlService()->load($file);

    }
}
