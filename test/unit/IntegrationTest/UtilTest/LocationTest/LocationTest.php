<?php
namespace GearTest\IntegrationTest\UtilTest\LocationTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Util\Location\Location;

/**
 * @group Service
 */
class LocationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = new Location();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Util\Location\Location', $this->service);
    }
}
