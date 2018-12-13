<?php
namespace GearTest\IntegrationTest\ComponentTest\SuperTestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\SuperTestFile\SuperTestFileFactory;

/**
 * @group Gear
 * @group SuperTestFile
 * @group Service
 */
class SuperTestFileFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Util\Persist\Persist')
            ->willReturn($this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new SuperTestFileFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Component\SuperTestFile\SuperTestFile', $instance);
    }
}
