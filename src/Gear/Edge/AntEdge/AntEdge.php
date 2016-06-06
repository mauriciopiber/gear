<?php
namespace Gear\Edge\AntEdge;

use Gear\Edge\AbstractEdge;

class AntEdge extends AbstractEdge
{
    public function getAntModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/ant.yml';

        return $this->getYamlService()->load($file);

    }

    public function getAntProject($type = 'web')
    {
        $file = $this->getProjectLocation($type).'/ant.yml';

        return $this->getYamlService()->load($file);

    }
}
