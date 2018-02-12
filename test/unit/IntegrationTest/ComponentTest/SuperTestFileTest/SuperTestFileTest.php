<?php
namespace GearTest\IntegrationTest\ComponentTest\SuperTestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;

/**
 * @group Service
 */
class SuperTestFileTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->persist = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');

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
