<?php
namespace Gear\Edge;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Edge\AbstractEdge;

class DirEdge extends AbstractEdge implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

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
