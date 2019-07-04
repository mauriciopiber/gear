<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator;

/**
 * @group Service
 */
class ControllerMvcGeneratorTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->gearFile = $this->prophesize(GearFile::class);
        $this->testFile = $this->prophesize(TestFile::class);
        $this->resolveNames = $this->prophesize(ResolveNames::class);
        $this->columns = $this->prophesize(Columns::class);

        $this->service = new ControllerMvcGenerator(
            $this->gearFile->reveal(),
            $this->testFile->reveal(),
            $this->resolveNames->reveal(),
            $this->columns->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator', $this->service);
    }
}
