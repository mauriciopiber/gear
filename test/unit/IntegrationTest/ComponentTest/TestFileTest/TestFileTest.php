<?php
namespace GearTest\IntegrationTest\ComponentTest\TestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Integration\Util\Persist\Persist;
use Gear\Integration\Component\TestFile\TestFile;

/**
 * @group Service
 */
class TestFileTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->persist = $this->prophesize(Persist::class);
        $this->stringService = $this->prophesize(StringService::class);

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
