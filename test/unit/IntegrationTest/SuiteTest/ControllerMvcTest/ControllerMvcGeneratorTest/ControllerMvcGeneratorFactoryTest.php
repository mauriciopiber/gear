<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorFactory;

/**
 * @group Gear
 * @group ControllerMvcGenerator
 * @group Service
 */
class ControllerMvcGeneratorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Component\GearFile\GearFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\GearFile\GearFile')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\TestFile\TestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\TestFile\TestFile')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Util\ResolveNames\ResolveNames')
            ->willReturn($this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Util\Columns\Columns')
            ->willReturn($this->prophesize('Gear\Integration\Util\Columns\Columns')->reveal())
            ->shouldBeCalled();

        $factory = new ControllerMvcGeneratorFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator', $instance);
    }
}
