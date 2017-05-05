<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;

/**
 * @group Service
 */
class ControllerMvcMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->controllerMvcMajorSuite = new ControllerMvcMajorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite', $this->controllerMvcMajorSuite);
    }
}
