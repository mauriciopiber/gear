<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\MigrationFile\MigrationFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator;

/**
 * @group Service
 */
class MvcGeneratorTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->gearFile = $this->prophesize(GearFile::class);
        $this->testFile = $this->prophesize(TestFile::class);
        $this->migrationFile = $this->prophesize(MigrationFile::class);
        $this->resolveNames = $this->prophesize(ResolveNames::class);
        $this->columns = $this->prophesize(Columns::class);

        $this->service = new MvcGenerator(
            $this->gearFile->reveal(),
            $this->testFile->reveal(),
            $this->migrationFile->reveal(),
            $this->resolveNames->reveal(),
            $this->columns->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator', $this->service);
    }
}
