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

        $this->controllerMvcMajorSuite = $this->prophesize(ControllerMvcMajorSuite::class);
        $this->controllerMvcMinorSuite = new ControllerMvcMinorSuite($this->controllerMvcMajorSuite->reveal(), null, null, null, null, true);

    }

    public function testControllerMvcMajorSuite()
    {
        $this->controllerMvcMajorSuite->getSuite()->willReturn('controller-mvc')->shouldBeCalled();
        $this->assertEquals($this->controllerMvcMajorSuite->reveal(), $this->controllerMvcMinorSuite->getMajorSuite());
        $this->assertEquals('controller-mvc/controller-mvc', $this->controllerMvcMinorSuite->getLocationKey());
        $this->assertTrue($this->controllerMvcMinorSuite->isUsingLongName());
    }
}
