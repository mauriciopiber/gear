<?php
namespace Gear\Edge;

use Gear\Edge\AbstractEdge;

class DirEdge extends AbstractEdge
{
    public function getDirModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/dir.yml';

        return $this->getYamlService()->load($file);
    }

    public function getDirProject($type = 'web')
    {
        $file = $this->getProjectLocation($type).'/dir.yml';

        return $this->getYamlService()->load($file);
    }
}
