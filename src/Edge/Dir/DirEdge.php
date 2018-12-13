<?php
namespace Gear\Edge\Dir;

use Gear\Edge\AbstractEdge;

class DirEdge extends AbstractEdge
{
    public function getDirModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/dir.yml';

        return $this->getYamlService()->load($file);
    }
}
