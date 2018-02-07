<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;

/**
 * @group Service
 */
class ControllerMvcSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controllerMvcGenerator = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator');
        $this->superTestFile = $this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile');

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
