<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class ControllerMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->majorSuite = $this->prophesize(ControllerMajorSuite::class);
        $this->controllerMinorSuite = new ControllerMinorSuite($this->majorSuite->reveal(), 'Action', 1, true);
    }

    public function testControllerMinorSuite()
    {
        $this->majorSuite->getSuite()->willReturn('controller')->shouldBeCalled();
        $this->assertEquals($this->majorSuite->reveal(), $this->controllerMinorSuite->getMajorSuite());
        $this->assertEquals('Action', $this->controllerMinorSuite->getType());
        $this->assertEquals('controller/controller-action', $this->controllerMinorSuite->getLocationKey());
        $this->assertTrue($this->controllerMinorSuite->isUsingLongName());

        //$this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerMinorSuite', $this->controllerMinorSuite);
    }
}
