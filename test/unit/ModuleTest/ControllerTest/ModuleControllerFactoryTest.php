<?php
namespace GearTest\ModuleTest\UpgradeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Module
 * @group ModuleController
 * @group Xhprof
 * @group Upgrade
 */
class ModuleControllerFactoryTest extends TestCase
{
    public function testCreateFactory()
    {

        $this->container = $this->prophesize('Zend\Mvc\Controller\ControllerManager');

        $factory = new \Gear\Module\Controller\ModuleControllerFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Controller\ModuleController', $instance);
    }
}
