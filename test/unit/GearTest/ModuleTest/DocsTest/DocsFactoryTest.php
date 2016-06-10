<?php
namespace GearTest\ModuleTest\DocsTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Docs
 */
class DocsFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Module\Docs\DocsFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\Docs\Docs', $instance);
    }
}
