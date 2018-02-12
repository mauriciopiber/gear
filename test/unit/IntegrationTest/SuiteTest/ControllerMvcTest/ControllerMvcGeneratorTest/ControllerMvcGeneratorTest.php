<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator;

/**
 * @group Service
 */
class ControllerMvcGeneratorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gearFile = $this->prophesize('Gear\Integration\Component\GearFile\GearFile');
        $this->testFile = $this->prophesize('Gear\Integration\Component\TestFile\TestFile');
        $this->resolveNames = $this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames');
        $this->columns = $this->prophesize('Gear\Integration\Util\Columns\Columns');

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
