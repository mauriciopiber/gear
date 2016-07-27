<?php
namespace MyModuleTest\ControllerTest;

use GearBaseTest\AbstractTestCase;

class IndexControllerFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator->get('application')->shouldBeCalled();
        $this->serviceLocator->get('eventManager')->shouldBeCalled();

        $this->controllerManager = $this->prophesize('Zend\Mvc\Controller\ControllerManager');
        $this->controllerManager->getServiceLocator()->willReturn($this->serviceLocator->reveal())->shouldBeCalled();

        $factory = new \MyModule\Controller\IndexControllerFactory();

        $instance = $factory->createService($this->controllerManager->reveal());

        $this->assertInstanceOf('MyModule\Controller\IndexController', $instance);
    }
}
