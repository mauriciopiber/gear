<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\FileService;

class FileServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new FileService(
            $serviceLocator->get('moduleStructure')
        );
        unset($serviceLocator);
        return $factory;
    }
}
