<?php
namespace GearTest\IntegrationTest\ComponentTest\TestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\TestFile\TestFile;

/**
 * @group Service
 */
class TestFileTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->persist = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');

        $this->service = new TestFile(
            $this->persist->reveal(),
            $this->stringService->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Component\TestFile\TestFile', $this->service);
    }
}
