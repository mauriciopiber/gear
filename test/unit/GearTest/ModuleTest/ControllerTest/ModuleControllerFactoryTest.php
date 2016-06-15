<?php
namespace GearTest\ModuleTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Module
 * @group ModuleController
 * @group Upgrade
 */
class ModuleControllerFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator->get('application')->shouldBeCalled();
        $this->serviceLocator->get('eventManager')->shouldBeCalled();

        $this->controllerManager = $this->prophesize('Zend\Mvc\Controller\ControllerManager');
        $this->controllerManager->getServiceLocator()->willReturn($this->serviceLocator->reveal())->shouldBeCalled();

        $factory = new \Gear\Module\Controller\ModuleControllerFactory();

        $instance = $factory->createService($this->controllerManager->reveal());

        $this->assertInstanceOf('Gear\Module\Controller\ModuleController', $instance);
    }
}
