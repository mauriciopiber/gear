<?php
namespace GearTest\IntegrationTest\ComponentTest\MigrationFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Vector\ArrayService;
use Gear\Util\String\StringService;
use Gear\Integration\Util\Persist\Persist;
use Gear\Integration\Component\MigrationFile\MigrationFile;

/**
 * @group Service
 */
class MigrationFileTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->persist = $this->prophesize(Persist::class);
        $this->stringService = $this->prophesize(StringService::class);
        $this->arrayService = $this->prophesize(ArrayService::class);

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
