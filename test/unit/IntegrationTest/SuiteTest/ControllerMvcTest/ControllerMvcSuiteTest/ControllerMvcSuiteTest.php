<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;

/**
 * @group Service
 */
class ControllerMvcSuiteTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->controllerMvcGenerator = $this->prophesize(ControllerMvcGenerator::class);
        $this->superTestFile = $this->prophesize(SuperTestFile::class);

        $this->service = new ControllerMvcSuite(
            $this->controllerMvcGenerator->reveal(),
            $this->superTestFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite', $this->service);
    }
}
