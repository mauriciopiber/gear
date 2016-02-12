<?php
namespace Gear\Creactor;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;


class FileNamespace implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function getNamespace()
    {

        $namespace = '';
        return $namespace;

    }
}
