<?php
namespace Gear\Module\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DiagnosticServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {


        return new \Gear\Module\Diagnostic\DiagnosticService(
            $serviceLocator->get('console'),
            $serviceLocator->get('moduleStructure')
        );
    }
}
