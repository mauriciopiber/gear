<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorFactory;

/**
 * @group Gear
 * @group SrcGenerator
 * @group Service
 */
class SrcGeneratorFactoryTest extends TestCase
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

        $factory = new SrcGeneratorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator', $instance);
    }
}
