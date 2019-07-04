<?php
namespace GearTest\IntegrationTest\ComponentTest\SuperTestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Integration\Util\Persist\Persist;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;

/**
 * @group Service
 */
class SuperTestFileTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->persist = $this->prophesize(Persist::class);
        $this->stringService = $this->prophesize(StringService::class);

        $this->service = new SuperTestFile(
            $this->persist->reveal(),
            $this->stringService->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Component\SuperTestFile\SuperTestFile', $this->service);
    }
}
