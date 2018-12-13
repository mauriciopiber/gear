<?php
namespace GearTest\IntegrationTest\UtilTest\PersistTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\Persist\PersistFactory;

/**
 * @group Gear
 * @group Persist
 * @group Service
 */
class PersistFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Util\Location\Location')
            ->willReturn($this->prophesize('Gear\Integration\Util\Location\Location')->reveal())
            ->shouldBeCalled();

        $factory = new PersistFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Util\Persist\Persist', $instance);
    }
}
