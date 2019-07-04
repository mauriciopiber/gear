<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\MigrationFile\MigrationFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;

/**
 * @group Service
 */
class SrcMvcGeneratorTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->gearFile = $this->prophesize(GearFile::class);
        $this->testFile = $this->prophesize(TestFile::class);
        $this->migrationFile = $this->prophesize(MigrationFile::class);
        $this->resolveNames = $this->prophesize(ResolveNames::class);
        $this->columns = $this->prophesize(Columns::class);

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
