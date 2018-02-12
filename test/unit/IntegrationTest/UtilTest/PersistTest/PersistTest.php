<?php
namespace GearTest\IntegrationTest\UtilTest\PersistTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\Persist\Persist;

/**
 * @group Service
 */
class PersistTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->location = $this->prophesize('Gear\Integration\Util\Location\Location');

        $this->service = new Persist(
            $this->location->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Util\Persist\Persist', $this->service);
    }
}
