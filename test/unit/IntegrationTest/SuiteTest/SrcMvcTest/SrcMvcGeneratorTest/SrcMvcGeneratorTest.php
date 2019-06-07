<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;

/**
 * @group Service
 */
class SrcMvcGeneratorTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->gearFile = $this->prophesize('Gear\Integration\Component\GearFile\GearFile');
        $this->testFile = $this->prophesize('Gear\Integration\Component\TestFile\TestFile');
        $this->migrationFile = $this->prophesize('Gear\Integration\Component\MigrationFile\MigrationFile');
        $this->resolveNames = $this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames');
        $this->columns = $this->prophesize('Gear\Integration\Util\Columns\Columns');

        $this->service = new SrcMvcGenerator(
            $this->gearFile->reveal(),
            $this->testFile->reveal(),
            $this->migrationFile->reveal(),
            $this->resolveNames->reveal(),
            $this->columns->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator', $this->service);
    }
}
