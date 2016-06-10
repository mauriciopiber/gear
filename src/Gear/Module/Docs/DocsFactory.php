<?php
namespace Gear\Module\Docs;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Docs\Docs;

class DocsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Docs(
        );
        unset($serviceLocator);
        return $factory;
    }
}
