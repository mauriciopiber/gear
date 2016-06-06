<?php
namespace Gear\Edge;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Edge\AbstractEdge;

class AntEdge extends AbstractEdge implements ServiceLocatorAwareInterface
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
