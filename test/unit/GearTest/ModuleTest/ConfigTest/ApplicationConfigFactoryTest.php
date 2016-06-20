<?php
namespace GearTest\ModuleTest\ConfigTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group ApplicationConfig
 */
class ApplicationConfigFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator
          ->get('moduleStructure')
          ->willReturn($this->prophesize('Gear\Module\BasicModuleStructure'))
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('Request')
          ->willReturn($this->prophesize('Zend\Console\Request'))
          ->shouldBeCalled();

        $factory = new \Gear\Module\Config\ApplicationConfigFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\Config\ApplicationConfig', $instance);
    }
}
