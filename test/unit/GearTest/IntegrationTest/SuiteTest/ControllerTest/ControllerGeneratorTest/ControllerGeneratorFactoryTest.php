<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Component\GearFile\GearFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\GearFile\GearFile')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\TestFile\TestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\TestFile\TestFile')->reveal())
            ->shouldBeCalled();

        $factory = new ControllerGeneratorFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator', $instance);
    }
}
