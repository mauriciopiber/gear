<?php
namespace Gear\Edge;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Edge\AbstractEdge;

class FileEdge extends AbstractEdge implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function getFileModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/file.yml';

        return $this->getYamlService()->load($file);

    }

    public function getFileProject($type = 'web')
    {
        $file = $this->getProjectLocation($type).'/file.yml';

        return $this->getYamlService()->load($file);

    }
}
