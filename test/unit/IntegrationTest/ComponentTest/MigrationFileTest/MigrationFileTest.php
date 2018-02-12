<?php
namespace GearTest\IntegrationTest\ComponentTest\MigrationFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\MigrationFile\MigrationFile;

/**
 * @group Service
 */
class MigrationFileTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->persist = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
        $this->arrayService = $this->prophesize('Gear\Util\Vector\ArrayService');

        $this->service = new MigrationFile(
            $this->persist->reveal(),
            $this->stringService->reveal(),
            $this->arrayService->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Component\MigrationFile\MigrationFile', $this->service);
    }
}
