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
        $this->majorSuite = new ControllerMajorSuite();
        $this->controllerMinorSuite = new ControllerMinorSuite($this->majorSuite, 'Action', 1);
    }

    public function testControllerMinorSuite()
    {
        $this->assertEquals($this->majorSuite, $this->controllerMinorSuite->getMajorSuite());

        //$this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerMinorSuite', $this->controllerMinorSuite);
    }
}
