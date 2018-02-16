<?php
namespace GearTest\ModuleTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group ApplicationConfig
 */
class ApplicationConfigFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator
          ->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure'))
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
