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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container
          ->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure'))
          ->shouldBeCalled();

        $this->container
          ->get('Request')
          ->willReturn($this->prophesize('Zend\Console\Request'))
          ->shouldBeCalled();

        $factory = new \Gear\Module\Config\ApplicationConfigFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Config\ApplicationConfig', $instance);
    }
}
