<?php
namespace Gear\Diagnostic\Composer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Composer\ComposerService;
use Gear\Edge\Composer\ComposerEdge;

class ComposerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(ComposerEdge::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
