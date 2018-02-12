<?php
namespace Gear\Diagnostic\Dir;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Dir\DirService;
use Gear\Edge\Dir\DirEdge;

class DirServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DirService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(DirEdge::class)
        );
    }
}
