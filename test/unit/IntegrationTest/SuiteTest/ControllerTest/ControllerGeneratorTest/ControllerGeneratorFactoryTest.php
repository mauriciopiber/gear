<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\GearFile\GearFile;
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
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(GearFile::class)
            ->willReturn($this->prophesize(GearFile::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(TestFile::class)
            ->willReturn($this->prophesize(TestFile::class)->reveal())
            ->shouldBeCalled();

        $factory = new ControllerGeneratorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator', $instance);
    }
}
