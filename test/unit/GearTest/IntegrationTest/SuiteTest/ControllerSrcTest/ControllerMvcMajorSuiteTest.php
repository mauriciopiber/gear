<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerSrc\ControllerMvcMajorSuite;

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
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerSrc\ControllerMvcMajorSuite', $this->controllerMvcMajorSuite);
    }
}
