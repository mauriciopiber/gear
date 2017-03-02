<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit_Framework_TestCase as TestCase;

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

        $factory = new \Gear\Database\Phinx\PhinxServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Database\Phinx\PhinxService', $instance);
    }
}
