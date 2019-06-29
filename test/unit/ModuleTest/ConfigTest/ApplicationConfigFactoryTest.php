<?php
namespace GearTest\ModuleTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Config\ApplicationConfigFactory;
use Zend\Console\Request;
use Interop\Container\ContainerInterface;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group ApplicationConfig
 */
class ApplicationConfigFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container
          ->get(ModuleStructure::class)
          ->willReturn($this->prophesize(ModuleStructure::class))
          ->shouldBeCalled();

        $this->container
          ->get('Request')
          ->willReturn($this->prophesize(Request::class))
          ->shouldBeCalled();

        $factory = new ApplicationConfigFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Config\ApplicationConfig', $instance);
    }
}
