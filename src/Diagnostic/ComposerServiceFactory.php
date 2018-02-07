<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\ComposerService;

class ComposerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerService(
            $serviceLocator->get('moduleStructure')
        );
        unset($serviceLocator);
        return $factory;
    }
}
