<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNamesFactory;

/**
 * @group Gear
 * @group ResolveNames
 * @group Service
 */
class ResolveNamesFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new ResolveNamesFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Util\ResolveNames\ResolveNames', $instance);
    }
}
