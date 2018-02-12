<?php
namespace Gear\Edge\Ant;

use Gear\Edge\AbstractEdge;

class AntEdge extends AbstractEdge
{
    public function getAntModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/ant.yml';

        return $this->getYamlService()->load($file);
    }
}
