<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;

/**
 * @group MinorSuite
 */
class ControllerMvcMinorSuiteTest extends TestCase
{
    public function testControllerMvcMajorSuite()
    {
        $this->controllerMvcMajorSuite = new ControllerMvcMajorSuite();

        $this->controllerMvcMinorSuite = new ControllerMvcMinorSuite($this->controllerMvcMajorSuite);

        $this->assertEquals($this->controllerMvcMajorSuite, $this->controllerMvcMinorSuite->getMajorSuite());

    }
}
