<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group PhinxService
 * @group Service
 */
class PhinxServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Util\String\StringService')
          ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Creator\FileCreator\FileCreator')
          ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
          ->shouldBeCalled();

        $factory = new \Gear\Database\Phinx\PhinxServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Database\Phinx\PhinxService', $instance);
    }
}
