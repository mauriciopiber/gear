<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class ControllerMvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controllerMvcMajorSuite = new ControllerMvcMajorSuite();
        $this->controllerMvcMinorSuite = new ControllerMvcMinorSuite($this->controllerMvcMajorSuite);

    }

    public function testControllerMvcMajorSuite()
    {
        $this->assertEquals($this->controllerMvcMajorSuite, $this->controllerMvcMinorSuite->getMajorSuite());
    }
}
