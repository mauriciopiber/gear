<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerSrc\ControllerMvcMinorSuite;

/**
 * @group Service
 */
class ControllerMvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->controllerMvcMinorSuite = new ControllerMvcMinorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerSrc\ControllerMvcMinorSuite', $this->controllerMvcMinorSuite);
    }
}
