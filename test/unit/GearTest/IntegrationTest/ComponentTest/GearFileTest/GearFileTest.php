<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Component\GearFile\GearFile;

/**
 * @group Service
 */
class GearFileTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->persist = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');

        $this->service = new GearFile(
            $this->persist->reveal(),
            $this->stringService->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Component\GearFile\GearFile', $this->service);
    }
}
