<?php
namespace Gear\Mvc\Spec\UnitTest;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Spec\UnitTest\UnitTest;

class UnitTestFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new UnitTest(
        );
        unset($serviceLocator);
        return $factory;
    }
}
