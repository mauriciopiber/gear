<?php
namespace GearTest\IntegrationTest\UtilTest\LocationTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\Location\LocationTrait;

/**
 * @group Gear
 * @group Location
 * @group Service
 */
class LocationTraitTest extends TestCase
{

    use LocationTrait;

    public function testGet()
    {
        $serviceLocator = $this->getLocation();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\Location\Location')->reveal();
        $this->setLocation($mocking);
        $this->assertEquals($mocking, $this->getLocation());
    }
}
