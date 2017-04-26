<?php
namespace GearTest\IntegrationTest\UtilTest\LocationTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\Location\LocationTrait;

/**
 * @group Gear
 * @group Location
 * @group Service
 */
class LocationTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use LocationTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Util\Location\Location');
        $serviceManager->setService('Gear\Integration\Util\Location\Location', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getLocation();
        $this->assertInstanceOf('Gear\Integration\Util\Location\Location', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\Location\Location')->reveal();
        $this->setLocation($mocking);
        $this->assertEquals($mocking, $this->getLocation());
    }
}
