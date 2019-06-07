<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGeneratorFactory;

/**
 * @group Gear
 * @group ControllerGenerator
 * @group Service
 */
class ControllerGeneratorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Component\GearFile\GearFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\GearFile\GearFile')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Component\TestFile\TestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\TestFile\TestFile')->reveal())
            ->shouldBeCalled();

        $factory = new ControllerGeneratorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator', $instance);
    }
}
