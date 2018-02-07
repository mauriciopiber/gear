<?php
namespace Gear\Project\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DiagnosticServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Project\Diagnostic\DiagnosticService(
            $serviceLocator->get('console')
        );
    }
}
