<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Controller\ControllerMajorSuite;

/**
 * @group Service
 */
class ControllerMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->controllerMajorSuite = new ControllerMajorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerMajorSuite', $this->controllerMajorSuite);
    }
}
